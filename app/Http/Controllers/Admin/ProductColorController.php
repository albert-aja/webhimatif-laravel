<?php

namespace App\Http\Controllers;

use App\Models\Product_Color;
use Illuminate\Http\Request;

class ProductColorController extends Controller
{

	public function warna(){
		$this->data['title'] = 'Warna';
		
		return view('v_admin/shop/warna/data', $this->data);
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
		
		return view('v_admin/shop/warna/add', $this->data);
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
		
		return view('v_admin/shop/warna/edit', $this->data);
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
     * @param  \App\Models\Product_Color  $product_Color
     * @return \Illuminate\Http\Response
     */
    public function show(Product_Color $product_Color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product_Color  $product_Color
     * @return \Illuminate\Http\Response
     */
    public function edit(Product_Color $product_Color)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product_Color  $product_Color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product_Color $product_Color)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product_Color  $product_Color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product_Color $product_Color)
    {
        //
    }
}
