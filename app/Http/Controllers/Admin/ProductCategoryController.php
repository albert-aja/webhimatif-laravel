<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product_Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProductCategoryController extends AdminController
{
	public function __construct(){
		parent::__construct();
		$this->data['page'] = ['page' => 'Kategori Produk'];
	}

    public function index(){
        $this->data['title'] = __('admin/crud.data', $this->data['page']);

		if(request()->ajax()){
            return Datatables::of(Product_Category::query())
					->editColumn('photo', function($item){
						return '<img src="' .asset('img/web/shop/' .$item['photo']). '" style="width: 5rem;">';
					})
					->addColumn('action', function($item){
						return '<div class="dropdown d-inline">
									<button class="btn btn-warning dropdown-toggle me-1 mb-1" type="button" data-bs-toggle="dropdown">' .__('admin/crud.btn.action'). '</button>
									<div class="dropdown-menu">
										<a type="button" class="dropdown-item has-icon editCategory" data-id="' .$item->id. '">
											<i class="fas fa-pen"></i> ' .__('admin/crud.btn.edit'). '
										</a>
										<a type="button" class="dropdown-item has-icon deleteCategory" data-id="' .$item->id. '" data-category="' .$item->category. '">
											<i class="fas fa-times"></i> ' .__('admin/crud.btn.delete'). '
										</a>
									</div>
								</div>';
					})
					->rawColumns(['photo', 'action'])
					->addIndexColumn()
					->make();
        }

		return view('v_admin.shop.category.data', $this->data);
    }

    public function create(){
        //
    }

    public function store(Request $request){
        //
    }

    public function edit(Product_Category $product_Category){
        //
    }

    public function update(Request $request, Product_Category $product_Category){
        //
    }

    public function destroy(Product_Category $product_Category){
        //
    }

	public function view_add_category(){
		$this->data['title'] = 'Tambah Kategori';
		
		return view('v_admin/shop/kategori/add', $this->data);
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
		session()->setFlashdata('pesan', 'Kategori <b>' .$kategori. '</b> {{ __("admin/swal.successItem") }}".');
		
		return redirect()->to('/Admin/Shop/Kategori');
	}

	public function view_edit_category(){
		$id = $this->request->getVar('id');

		$this->data['title'] = 'Edit kategori';

		$this->data['kategori'] = $this->m_kategoriProduk->find($id);
		
		return view('v_admin/shop/kategori/edit', $this->data);
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
}
