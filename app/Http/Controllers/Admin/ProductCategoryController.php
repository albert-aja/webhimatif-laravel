<?php

namespace App\Http\Controllers;

use App\Models\Product_Category;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{

	public function kategori(){
		$this->data['title'] = 'Kategori';
		
		return view('v_admin/shop/kategori/data', $this->data);
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
		session()->setFlashdata('pesan', 'Kategori <b>' .$kategori. '</b> telah ditambahkan.');
		
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
     * @param  \App\Models\Product_Category  $product_Category
     * @return \Illuminate\Http\Response
     */
    public function show(Product_Category $product_Category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product_Category  $product_Category
     * @return \Illuminate\Http\Response
     */
    public function edit(Product_Category $product_Category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product_Category  $product_Category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product_Category $product_Category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product_Category  $product_Category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product_Category $product_Category)
    {
        //
    }
}
