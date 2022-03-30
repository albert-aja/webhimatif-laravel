<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\General;
use App\Models\Shop_Item;
use App\Models\Product_Color;
use App\Models\Product_With_Color;
use App\Models\Product_Gallery;
use App\Models\Product_Category;
use App\Models\Product_Price;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Ramsey\Uuid\Uuid;

class ShopItemController extends AdminController
{
	public function __construct(){
		parent::__construct();
		$this->data['page'] = ['page' => 'Produk'];
	}

	private function shop_image(string $category_slug, string $item_slug, string $filename = null){
		return $this->shop_dir.$category_slug. '/' .$item_slug. '/' .($filename) ?? '';
	}

	private function prepare_image($img, string $category_slug = '', 
									string $item_slug = '', string $folderPath = ''){
		$filename = Uuid::uuid4().'.'.$img->extension();

		if ($folderPath == ''){
			$folderPath = public_path(self::shop_image($category_slug, $item_slug, $filename));
		} else {
			$folderPath .= $filename;
		}

		self::makedir($folderPath);

		$resize = [800, 500, 300, 70];

		self::saveResized($resize, $img, $folderPath, $filename);

		return $filename;
	}

	public function index(){
		$this->data['title'] = __('admin/crud.data', $this->data['page']);

		if(request()->ajax()){
            return Datatables::of(Shop_Item::query())
					->addColumn('photo', function($item){
						$photos = $item->product_gallery->pluck('photo')->toArray();
						$img_loc = self::shop_image($item->product_category->slug, $item['slug']);
						$img = '';

						foreach($photos as $photo){
							$img .= '<img src="' .asset($img_loc. '/' .$photo. '/4x_' .$photo). '" style="width: 25;">';
						}

						return $img;
					})
					->addColumn('price', function($item){
						$prices = $item->product_price->pluck('price')->toArray();

						foreach($prices as &$price){
							$price = General::convert_money($price);
						}

						return implode(' - ', $prices);
					})
					->addColumn('category', function($item){
						return '<span class="badge rounded-pill bg-primary">' .$item->product_category->category. '</span>';
					})
					->addColumn('color', function($item){
						if(count($item->product_with_color) > 1){
							return '<span class="badge rounded-pill bg-success">' .__("admin/crud.wColors"). '</span>';
						}
						return '<span class="badge rounded-pill bg-danger">' .__("admin/crud.woColors"). '</span>';
					})
					->addColumn('action', function($item){
						$btn = [
							'<a type="button" class="dropdown-item has-icon editItem" data-id="' .$item->id. '">
								<i class="fas fa-pen"></i> ' .__('admin/crud.btn.edit'). '
							</a>',
							'<a type="button" class="dropdown-item has-icon deleteItem" data-item="' .$item->item. '" data-id="' .$item->id. '">
								<i class="fas fa-times"></i> ' .__('admin/crud.btn.delete'). '
							</a>',
						];

						if(count($item->product_gallery) > 1){
							array_push($btn, '<a type="button" class="dropdown-item has-icon" id="rearrangeItem" data-id="' .$item->id. '">
											<i class="fas fa-sync"></i> ' .__('admin/crud.btn.rearrange'). '
										</a>');
						}

						return '<div class="dropdown d-inline">
									<button class="btn btn-warning dropdown-toggle me-1 mb-1" type="button" data-bs-toggle="dropdown">' .__('admin/crud.btn.action'). '</button>
									<div class="dropdown-menu">'
										.implode('', $btn).
									'</div>
								</div>';
					})
					->rawColumns(['photo', 'description', 'category', 'color', 'action'])
					->addIndexColumn()
					->make();
        }

		return view('v_admin.shop.item.data', $this->data);
	}

    public function create(){
		$this->data['title'] 		= __('admin/crud.add', $this->data['page']);
		$this->data['categories'] 	= Product_Category::all();
		$this->data['colors'] 		= Product_Color::all();

        return view('v_admin.shop.item.modal_add', $this->data);
    }

    public function store(Request $request){
		$val = self::validator($request->all());

		if(!empty($val->errors()->messages())){
			$feedback = self::error_feedback($val);
		} else {
			$request['slug'] = Str::slug($request->item);

			$data = Shop_Item::create($request->input());

			$category_slug = Product_Category::where('id', $request->input('product__categories_id'))->first()->value('slug');
			$order = 1;

			foreach($request->file('photo') as $photo){
				Product_Gallery::create([
					'shop__items_id' 	=> $data->id,
					'photo' 			=> self::prepare_image($photo, $category_slug, $request['slug']),
					'photo_order'		=> $order,
				]);

				$order++;
			}

			$prices = array_filter([
				$request->input('fromPrice'),
				$request->input('toPrice'),
			]);

			foreach($prices as $price){
				Product_Price::create([
					'shop__items_id' 	=> $data->id,
					'price'				=> $price,
				]);
			}

			if($request->input('color')){
				foreach($request->input('color') as $color){
					Product_With_Color::create([
						'shop__items_id' 		=> $data->id,
						'product__colors_id'	=> $color
					]);
				}
			}

			$feedback['status'] = __('admin/crud.val_success');
		}

		echo json_encode($feedback);
    }

    public function edit(Request $request){
		$this->data['title'] 			= __('admin/crud.edit', $this->data['page']);
		$this->data['categories'] 		= Product_Category::all();
		$this->data['colors'] 			= Product_Color::all();
		$this->data['item'] 			= Shop_Item::where('id', $request->id)->first();
		$this->data['photos']			= implode(',', $this->data['item']->product_gallery->pluck('photo')->toArray());
		$this->data['img_path'] 		= self::shop_image($this->data['item']->product_category->slug, $this->data['item']['slug']);
		$this->data['product_colors']	= $this->data['item']->product_with_color->pluck('product__colors_id');
		$this->data['price'] 			= $this->data['item']->product_price->pluck('price');

        return view('v_admin.shop.item.modal_edit', $this->data);
    }

    public function update(Request $request){
		$val = self::validator($request->all(), $request->id);

		if(!empty($val->errors()->messages())){
			$feedback = self::error_feedback($val);
		} else {
			$request['slug'] = Str::slug($request->item);

			$db_data = Shop_Item::findOrFail($request->id);
			$item_id = $db_data->id;

			$old_image_path = self::shop_image($db_data->product_category->slug, $db_data->slug);

			$new_slug = Product_Category::where('id', '=', $request->input('product__categories_id'))->pluck('slug')->first();
			$new_image_path = self::shop_image($new_slug, $request->input('slug'));

			if($old_image_path != $new_image_path){
				rename($old_image_path, $new_image_path);
				$path = $new_image_path;
			} else {
				$path = $old_image_path;
			}

			$new_image_count = count($request->input('preloaded'));

			if($new_image_count != count($db_data->product_gallery)){
				$order = 1;
				foreach($db_data->product_gallery as $old_image){
					if(!in_array($old_image->photo, $request->input('preloaded'))){
						General::clearStorage($path. '/' .$old_image->photo);
						$old_image->delete();
					} else {
						$old_image->fill([
							'photo_order' => $order,
						])->save();
						$order++;
					}
				}
			}

			$order = $new_image_count + 1;

			if($request->file('photo')){
				foreach($request->file('photo') as $photo){
					Product_Gallery::create([
						'shop__items_id' 	=> $item_id,
						'photo' 			=> self::prepare_image($photo, folderPath: $path),
						'photo_order'		=> $order,
					]);

					$order++;
				}
			}

			$old_color = $db_data->product_with_color->pluck('product__colors_id')->toArray() ?? [];
			$new_color = $request->input('color');

			$old2new = array_diff($old_color, $new_color);
			$new2old = array_diff($new_color, $old_color);

			if(!is_null($old2new)){
				foreach($old2new as $color){
					Product_With_Color::where([
						['shop__items_id', '=', $item_id],
						['product__colors_id', '=', $color],
					])->delete();
				}
			}

			if(!is_null($new2old)){
				foreach($new2old as $color){
					Product_With_Color::create([
						'shop__items_id' 		=> $item_id,
						'product__colors_id'	=> $color
					]);
				}
			}

			$prices = array_filter([
				$request->input('fromPrice'),
				$request->input('toPrice'),
			]);

			$db_prices = $db_data->product_price;
			$count_price = count($db_prices);

			if (count($prices) > $count_price){
				Product_Price::create([
					'shop__items_id' 	=> $item_id,
					'price'				=> $prices[1],
				]);
			} else if (count($prices) < $count_price){
				Product_Price::where('shop__items_id', '=', $item_id)->get()->last()->delete();
			} else {
				for($i=0;$i<count($db_prices);$i++){
					$db_prices[$i]->fill([
						'price'	=> $prices[$i],
					])->save();
				}
			}

			$db_data->fill($request->input())->save();

			$feedback['status'] = __('admin/crud.val_success');
		}

		echo json_encode($feedback);
    }

    public function destroy(Request $request){
		$data = Shop_Item::findOrFail($request->id);
		General::clearStorage(self::shop_image($data->product_category->slug, $data['slug'], $data['photo']));
		$data->delete();
    }

    private function validator(array $data, string $id = ''){
        return Validator::make($data, [
			'item'						=> 'required|unique:shop__items' .(($id) ? ',item,'.$id : ''),
			'photo'						=> ($id) ? '' : 'required',
            'description'  				=> 'required',
            'product__categories_id'  	=> 'required|exists:product__categories,id',
            'fromPrice'  				=> 'required|integer',
            'toPrice'  					=> 'nullable|gt:fromPrice|integer',
		], [
			'item.required' 		=> __('admin/validation.required.input', ['field' => __('admin/crud.variable.item')]),
			'item.unique' 			=> __('admin/validation.unique.existed', ['field' => __('admin/crud.variable.item')]),
			'photo.required' 		=> __('admin/validation.required.upload', ['field' => __('admin/crud.variable.photo')]),
			'description.required' 	=> __('admin/validation.required.input', ['field' => __('admin/crud.variable.description')]),
			'fromPrice.required' 	=> __('admin/validation.required.input', ['field' => __('admin/crud.variable.price')]),
			'fromPrice.integer' 	=> __('admin/validation.integer', ['field' => __('admin/crud.variable.price')]),
			'toPrice.gt' 			=> __('admin/validation.gt'),
			'toPrice.integer' 		=> __('admin/validation.integer', ['field' => __('admin/crud.variable.price')]),
			'product__categories_id.required' 	=> __('admin/validation.required.select', ['field' => __('admin/crud.variable.category')]),
		]);
    }

	private function error_feedback($val){
		$feedback = [
			'status' 					=> __('admin/crud.val_failed'),
			'item' 						=> $val->errors()->first('item') ?? false,
			'photo' 					=> $val->errors()->first('photo') ?? false,
			'description' 				=> $val->errors()->first('description') ?? false,
			'product__categories_id' 	=> $val->errors()->first('product__categories_id') ?? false,
			'fromPrice'					=> $val->errors()->first('fromPrice') ?? false,
			'toPrice'	 				=> $val->errors()->first('toPrice') ?? false,
		];

		return $feedback;
	}

	public function update_item(){
		$id = $this->request->getVar('id');
		$item = $this->request->getVar('item');
		
		//validation 
		if(!$this->validate([
			'item' => [
				'rules'  => 'required|is_unique[shop.item,shop.id,'.$id.']',
				'errors' => [
					'required'  => 'Item belum memiliki nama',
					'is_unique' => 'Item <b>'.$item.'</b> sudah ada',				
				]
			],
			'deskripsi' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Item belum memiliki deskripsi.',
				]
			],
			'kategori' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Item belum memiliki kategori.'
				]
			],
			'harga' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Item belum memiliki harga',			
				]
			],
		])) {
			return redirect()->back()->withInput();
		}

		$old_data = $this->m_shop->find($id);

		$slug_item = url_title($item, '-', true);
		$kategori = $this->request->getVar('kategori');
		
		$slug_kategori = $this->m_kategoriProduk->getSlugById($kategori)['slug'];

		$old_slug_kategori = $this->m_kategoriProduk->getSlugById($old_data['kategori'])['slug'];
		
		if($slug_kategori. '/' .$slug_item != $old_slug_kategori. '/' .$old_data['slug']){
			$folder_path = $this->shop_dir.$slug_kategori. '/' .$slug_item;
		} else {
			$folder_path = $this->shop_dir.$old_slug_kategori. '/' .$old_data['slug'];
		}
		
		$new_img = $this->request->getFileMultiple('foto');
		$old_img = $this->request->getVar('preloaded');
		
		$old_img_arr = explode(',', $old_data['foto']);

		if($new_img[0]->getError() == 4){
			
			if(count($old_img) < count($old_img_arr)){
				$new_img_collection = [];

				foreach($old_img as $oi){
					array_push($new_img_collection, $old_img_arr[$oi-1]);
				}

				$insert_to_db_img = implode(',', $new_img_collection);
			} else {
				$insert_to_db_img = $old_data['foto'];
			}
		} else {
			if(count($new_img) + count($old_img) > 10){
				$msg = 'Jumlah maksimal gambar adalah 10';
				return redirect()->back()->with('msg', $msg)->withInput();
			}
			
			foreach($new_img['foto'] as $img)
			{
				$name = $img->getName();

				if(!$this->validate([
					'foto' => [
						'rules'  => 'uploaded[foto]|mime_in[foto, image/jpg,image/jpeg,image/png]|is_image[foto]|max_size[foto, 5120]',
						'errors' => [
							'uploaded' => 'Foto belum di upload.',
							'mime_in'  => 'File bernama <b>' .$name. '</b> memiliki format yang tidak diizinkan.',
							'is_image' => 'File bernama <b>' .$name. '</b> bukan gambar.',
							'max_size' => 'File bernama <b>' .$name. '</b> melebihi batas maksimum 5mb.',
						]
					],
				])) {
					return redirect()->back()->withInput();
				}
			}

			$nama_foto = $this->uploadProccessing($new_img, $slug_kategori, $slug_item, $folder_path);

			if(count($old_img) < count($old_img_arr)){
				$new_img_collection = [];

				foreach($old_img as $oi){
					array_push($new_img_collection, $old_img_arr[$oi-1]);
				}

				$insert_to_db_img = implode(',', $new_img_collection). ',' .$nama_foto;
			} else{
				$insert_to_db_img = $old_data['foto']. ',' .$nama_foto;
			}
		}
		
		$deskripsi 	= $this->request->getVar('deskripsi');
		$harga 		= $this->request->getVar('harga');

		$colors = $this->request->getVar('color');

		if($colors != null){
			$colors = join(',', $colors);
		}

		//process update data 
		$this->m_shop->update($id, [
			'item' 		=> $item,
			'slug' 		=> $slug_item,
			'foto' 		=> $insert_to_db_img,
			'deskripsi' => $deskripsi,
			'kategori' 	=> $kategori,
			'warna' 	=> $colors,
			'harga' 	=> $harga,
		]);
		
		//pesan yang ditampilkan apabila input success
		session()->setFlashdata('pesan', 'Item <b>'.$item.'</b> telah diedit.');
		
		return redirect()->to('/Admin/Shop');
	}

	public function delete_item($id){
		$data = $this->m_shop->joinTable()->find($id);

		//path ke folder gambar
		$folder_path = $this->shop_dir.$data['slug_kategori'].'/'.$data['slug'];

		$this->truncateDir($folder_path);

		//hapus data dari database
		$this->m_shop->delete($id);

		return redirect()->to('/Admin/Shop');
	}

	public function delete_category($id){
		$data = $this->m_kategoriProduk->find($id);

		unlink('assets/img/web/shop/' .$data['foto']);

		$this->m_kategoriProduk->delete($id);
	}
}
