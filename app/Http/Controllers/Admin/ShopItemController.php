<?php

namespace App\Http\Controllers;

use App\Models\Shop_Item;
use Illuminate\Http\Request;

class ShopItemController extends Controller
{
	public function uploadProccessing($images, $slug_kategori, $slug_item, $folder_path = ''){
		$img_name = [];

		if($folder_path == ''){
			$folder_path = $this->dir_toko.$slug_kategori. '/' .$slug_item;
		}
		
		foreach($images['foto'] as $img){
			$name = $img->getRandomName();
			
			//membuat folder apabila belum ada
			if (!file_exists($folder_path. '/' .$name)) {
				@mkdir($folder_path. '/' .$name. '/', 0777, true);
			}
			
			//besar
			\Config\Services::image()
				->withFile($img)
				->resize(1000, 800, true, 'height')
				->save($folder_path. '/' .$name. '/1x_' .$name);

			//medium
			\Config\Services::image()
				->withFile($img)
				->resize(700, 500, true, 'height')
				->save($folder_path. '/' .$name. '/2x_' .$name);
			
			//kecil
			\Config\Services::image()
				->withFile($img)
				->resize(500, 300, true, 'height')
				->save($folder_path. '/' .$name. '/3x_' .$name);

			//superkecil
			\Config\Services::image()
				->withFile($img)
				->resize(150, 70, true, 'height')
				->save($folder_path. '/' .$name. '/4x_' .$name);

			array_push($img_name, $name);
		}
			
		//mengakali bug adanya file html kosong saat gambar disimpan
		$empty_file = $folder_path. '/index.html';
		
		//apabila index.html ada, maka dihapus
		if(file_exists($empty_file)){
			unlink($empty_file);
		}

		//mengembalikan nama gambar untuk disimpan ke dalam database
		return implode(',', $img_name);
	}

	public function index(){
		$this->data['title'] = 'Item';
	
		return view('v_server/shop/item/data', $this->data);
	}

	public function getItem(){
		$table = $this->table_data('shop');
		$data  = [];
		$no    = $table['start'] + 1;

		foreach($table['list'] as $tmp){
            $slug_kategori = $this->m_kategoriProduk->getSlugById($tmp['kategori'])['slug'];

			$img_loc = $this->dir_toko. $slug_kategori .'/'. $tmp['slug'];

			$row   = [];
			$row[] = $no;
			$row[] = $tmp['item'];

            $photo = explode(",", $tmp['foto']);
            
            $all_img = '';

            foreach($photo as $p){
                $all_img = $all_img.'<img src="' .base_url(). '/' .$img_loc. '/' .$p. '/4x_' .$p. '" style="width: 25;">';
            }

			// set route image
			$row[] = $all_img;

			$row[] = $tmp['deskripsi'];

            $row[] = $this->m_kategoriProduk->getDatabyId($tmp['kategori'])['kategori']; 

			$arr_harga = explode(",", $tmp['harga']);

			foreach ($arr_harga as &$ah) {
				$ah = convert_money($ah);
			}

			$row[] = implode(" - ", $arr_harga);

			//kolom untuk button
			$btn = [
				'<a href="/Admin/Shop/edit_item?id='.$tmp['id'].'" class="btn btn-icon icon-left btn-primary m-1" style="min-width: 5rem"><i class="fas fa-pen"></i> Edit</a>', 
				'<button class="btn btn-icon icon-left btn-danger hapusItem m-1"  data-item="' .$tmp['item']. '" data-id="' .$tmp['id']. '" type="button" style="min-width: 5rem"><i class="fas fa-times"></i> Hapus</button>'
			];

			if(count($photo) > 1){
				array_push($btn, '<button type="button" class="btn btn-icon icon-left btn-info" id="openModal" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-id="'.$tmp['id'].'"><i class="fas fa-sync"></i> Susun Gambar</button>');
			}

			$row[] = implode('', $btn);
			
			$data[] = $row;
			$no++;
		}
		
		$table['output']['data'] = $data;

		echo json_encode($table['output']);
		exit();
	}

	public function view_add_item(){
		$this->data['title'] = 'Tambah Item';

		$this->data['kategori'] = $this->m_kategoriProduk->findAll();
		$this->data['warna'] 	= $this->m_warna->findAll();

		return view('v_server/shop/item/add', $this->data);
	}

	public function add_item(){
		$item = $this->request->getVar('item');
		
		//validation 
		if(!$this->validate([
			'item' => [
				'rules'  => 'required|is_unique[shop.item]',
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
		
		if($images = $this->request->getFiles())
		{
			if(count($images['foto']) > 10){
				$msg = 'Jumlah maksimal gambar adalah 10';
				return redirect()->back()->with('msg', $msg)->withInput();
			}
			
			foreach($images['foto'] as $img)
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
		}
		
		//membuat slug dari title
		$slug_item = url_title($item, '-', true);
		$deskripsi = $this->request->getVar('deskripsi');
		$kategori  = $this->request->getVar('kategori');
		$harga 	   = $this->request->getVar('harga');
		
		$slug_kategori = $this->m_kategoriProduk->getSlugById($kategori)['slug'];

		$colors = $this->request->getVar('color');

		if($colors != null){
			$colors = join(',', $colors);
		}
		
		$nama_foto = $this->uploadProccessing($images, $slug_kategori, $slug_item);

		//process input data
		$this->m_shop->save([
			'item' 		=> $item,
			'slug' 		=> $slug_item,
			'foto' 		=> $nama_foto,
			'deskripsi' => $deskripsi,
			'kategori' 	=> $kategori,
			'warna' 	=> $colors,
			'harga' 	=> $harga,
		]);
		
		//pesan yang ditampilkan apabila input success
		session()->setFlashdata('pesan', 'Item <b>'.$item.'</b> telah ditambahkan.');
		
		return redirect()->to('/Admin/Shop/Item');
	}

	public function edit_item(){
		$id = $this->request->getVar('id');

		$this->data['title'] = 'Edit Produk';

		$this->data['item'] = $this->m_shop->find($id);
		
		$this->data['folder'] = $this->m_kategoriProduk->getSlugById($this->data['item']['kategori'])['slug']. '/' .$this->data['item']['slug']. '/';
		
		$this->data['kategori'] = $this->m_kategoriProduk->findAll();
		$this->data['warna'] = $this->m_warna->findAll();
		
		return view('v_server/shop/item/edit', $this->data);
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
			$folder_path = $this->dir_toko.$slug_kategori. '/' .$slug_item;
		} else {
			$folder_path = $this->dir_toko.$old_slug_kategori. '/' .$old_data['slug'];
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
		$folder_path = $this->dir_toko.$data['slug_kategori'].'/'.$data['slug'];

		$this->truncateDir($folder_path);

		//hapus data dari database
		$this->m_shop->delete($id);

		return redirect()->to('/Admin/Shop');
	}

	public function kategori(){
		$this->data['title'] = 'Kategori';
		
		return view('v_server/shop/kategori/data', $this->data);
	}

	public function getCategory(){
		$table = $this->table_data('kategoriProduk');
		
		$data = [];
		$no = $table['start'] + 1;

		foreach($table['list'] as $tmp){
			$row   = [];
			$row[] = $no;
			$row[] = $tmp['kategori'];
			$row[] = $tmp['slug'];
			$row[] = '<img src="/assets/img/web/shop/' .$tmp['foto']. '" style="width: 5rem;">';

			//kolom untuk button
			$row[] = '<a href="/Admin/Shop/view_edit_category?id='.$tmp['id'].'" class="btn btn-icon icon-left btn-primary m-1" style="min-width: 5rem"><i class="fas fa-pen"></i>Edit</a><button class="btn btn-icon icon-left btn-danger" id="delete_category" type="button" data-id="'.$tmp['id'].'" data-category="'.$tmp['kategori'].'" style="min-width: 5rem"><i class="fas fa-times"></i>Hapus</button>';
			
			$data[] = $row;
			$no++;
		}
		
		$table['output']['data'] = $data;

		echo json_encode($table['output']);
		exit();
	}

	public function view_add_category(){
		$this->data['title'] = 'Tambah Kategori';
		
		return view('v_server/shop/kategori/add', $this->data);
	}

	public function add_category(){
        $kategori = $this->request->getVar('kategori');
		
		//validation 
		if(!$this->validate([
			'kategori' => [
				'rules'  => 'required|is_unique[kategori_produk.kategori]',
				'errors' => [
					'required'  => 'Kategori masih kosong',
					'is_unique' => 'Kategori' .$kategori. 'sudah ada',				
				]
			],
			'foto' => [
				'rules'  => 'uploaded[foto]|mime_in[foto, image/jpg,image/jpeg,image/png]|is_image[foto]|max_size[foto, 5120]',
				'errors' => [
					'uploaded' => 'Foto belum di upload.',
					'mime_in'  => 'File memiliki format yang tidak diizinkan.',
					'is_image' => 'File bukan gambar.',
					'max_size' => 'File melebihi batas maksimum 5mb.',
				]
			],
		])) {
			return redirect()->to('/Admin/shop/view_add_category')->withInput();
		}

        $slug = url_title($kategori, '-', true);

		$image = $this->request->getFile('foto');

		$name = $image->getRandomName();
		
		\Config\Services::image()
			->withFile($image)
			->resize(700, 500, true, 'width')
			->save('assets/img/web/shop/' .$name);

		//process input data
		$this->m_kategoriProduk->save([
			'kategori' => $kategori,
			'slug' => $slug,
			'foto' => $name,
		]);
		
		//pesan yang ditampilkan apabila input success
		session()->setFlashdata('pesan', 'Kategori <b>' .$kategori. '</b> telah ditambahkan.');
		
		return redirect()->to('/Admin/Shop/Kategori');
	}

	public function view_edit_category(){
		$id = $this->request->getVar('id');

		$this->data['title'] = 'Edit kategori';

		$this->data['kategori'] = $this->m_kategoriProduk->find($id);
		
		return view('v_server/shop/kategori/edit', $this->data);
	}

	public function edit_category(){
        $kategori = $this->request->getVar('kategori');
        $id = $this->request->getVar('id');

		//validation 
		if(!$this->validate([
			'kategori' => [
				'rules'  => 'required|is_unique[kategori_produk.kategori,kategori_produk.id,'.$id.']',
				'errors' => [
					'required'  => 'Kategori masih kosong',
					'is_unique' => 'Kategori <b>' .$kategori. '</b> sudah ada',				
				]
			],
		])) {
			return redirect()->to('/Admin/shop/view_edit_category')->withInput();
		}

        $slug = url_title($kategori, '-', true);

		$image = $this->request->getFile('foto');
		$old_img = $this->request->getVar('old_img');

		if($image->getError() == 4){
			$name = $old_img;
		} else{
			$name = $image->getRandomName();
			
			\Config\Services::image()
				->withFile($image)
				->resize(700, 500, true, 'width')
				->save('assets/img/web/shop/' .$name);

			unlink('assets/img/web/shop/' .$old_img);
		}

		$this->m_kategoriProduk->update($id, [
			'kategori' 	=> $kategori,
			'slug' 		=> $slug,
			'foto' 		=> $name,
		]);
		
		//pesan yang ditampilkan apabila input success
		session()->setFlashdata('pesan', 'Kategori <b>' .$kategori. '</b> telah diedit.');
		
		return redirect()->to('/Admin/shop/kategori');
	}

	public function delete_category($id){
		$data = $this->m_kategoriProduk->find($id);

		unlink('assets/img/web/shop/' .$data['foto']);

		$this->m_kategoriProduk->delete($id);
	}

	public function warna(){
		$this->data['title'] = 'Warna';
		
		return view('v_server/shop/warna/data', $this->data);
	}

	public function getWarna(){
		$table = $this->table_data('warna');
		
		$data = [];
		$no = $table['start'] + 1;

		foreach($table['list'] as $tmp){
			$row   = [];
			$row[] = $no;
			$row[] = $tmp['warna'];
			$row[] = '<div style="background:'.$tmp['hex'].';" class="social-color"></div>';

			//kolom untuk button
			$row[] = '<a href="/Admin/Shop/view_edit_warna?id='.$tmp['id'].'" class="btn btn-icon icon-left btn-primary m-1" 
						style="min-width: 5rem"><i class="fas fa-pen"></i>Edit</a>
						<button class="btn btn-icon icon-left btn-danger" id="delete_warna" type="button" 
						data-id="'.$tmp['id'].'" data-warna="'.$tmp['warna'].'" style="min-width: 5rem">
						<i class="fas fa-times"></i>Hapus</button>';
			
			$data[] = $row;
			$no++;
		}
		
		$table['output']['data'] = $data;

		echo json_encode($table['output']);
		exit();
	}

	public function view_add_warna(){
		$this->data['title'] = 'Tambah Warna';
		
		return view('v_server/shop/warna/add', $this->data);
	}

	public function add_warna(){
        $warna 	= $this->request->getVar('warna');
        $hex 	= $this->request->getVar('hex');

		//validation 
		if(!$this->validate([
			'warna' => [
				'rules'  => 'required|is_unique[warna.warna]',
				'errors' => [
					'required'  => 'Warna masih kosong',
					'is_unique' => 'Warna <b>' .$warna. '</b> sudah ada',				
				]
			],
			'hex' => [
				'rules'  => 'required|is_unique[warna.hex]|regex_match[^#(?:[0-9a-fA-F]{3}){1,2}$]',
				'errors' => [
					'required'    => 'Hex masih kosong',
					'is_unique'   => 'Hex <b>' .$hex. '</b> sudah ada',
					'regex_match' => $hex. 'bukan merupakan hex code'				
				]
			],
		])) {
			return redirect()->back()->withInput();
		}
        
		//process input data
		$this->m_warna->save([
			'warna' => $warna,
			'hex' 	=> $hex,
		]);
		
		//pesan yang ditampilkan apabila input success
		session()->setFlashdata('pesan', 'Warna <b>' .$warna. '</b> telah ditambahkan.');
		
		return redirect()->to('/Admin/Shop/warna');
	}

	public function view_edit_warna(){
		$id = $this->request->getVar('id');

		$this->data['title'] = 'Edit Warna';

		$this->data['warna'] = $this->m_warna->find($id);
		
		return view('v_server/shop/warna/edit', $this->data);
	}

	public function edit_warna(){
		$id 	= $this->request->getVar('id');
        $warna 	= $this->request->getVar('warna');
        $hex 	= $this->request->getVar('hex');
		
		//validation 
		if(!$this->validate([
			'warna' => [
				'rules'  => 'required|is_unique[warna.warna, warna.id,'.$id.']',
				'errors' => [
					'required'  => 'Warna masih kosong',
					'is_unique' => 'Warna <b>' .$warna. '</b> sudah ada',				
				]
			],
			'hex' => [
				'rules'  => 'required|is_unique[warna.hex, warna.id,'.$id.']|regex_match[^#(?:[0-9a-fA-F]{3}){1,2}$]',
				'errors' => [
					'required'    => 'Hex masih kosong',
					'is_unique'   => 'Hex <b>' .$hex. '</b> sudah ada',
					'regex_match' => $hex. 'bukan merupakan hex code'				
				]
			],
		])) {
			return redirect()->back()->withInput();
		}
        
		$this->m_warna->save([
			'id' => $id,
			'warna' => $warna,
			'hex' => $hex,
		]);
		
		//pesan yang ditampilkan apabila input success
		session()->setFlashdata('pesan', 'Warna <b>' .$warna. '</b> telah diedit.');
		
		return redirect()->to('/Admin/Shop/warna');
	}

	public function delete_warna($id){
		$this->m_warna->delete($id);
	}
	
	public function rearanggeModal(){
		$id = $this->request->getVar('id');

		$this->data['item'] = $this->m_shop->joinTable()->where('shop.id', $id)->first();
		
		return view('v_server/shop/item/rearrange_modal', $this->data);
	}

	public function updateOrder(){
		$id = $this->request->getVar('id');

		$this->m_shop->update($id, [
			'foto' => $this->request->getVar('foto'),
		]);
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop_Item  $shop_Item
     * @return \Illuminate\Http\Response
     */
    public function show(Shop_Item $shop_Item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop_Item  $shop_Item
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop_Item $shop_Item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop_Item  $shop_Item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop_Item $shop_Item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop_Item  $shop_Item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop_Item $shop_Item)
    {
        //
    }
}
