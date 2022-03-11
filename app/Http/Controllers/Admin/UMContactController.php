<?php

namespace App\Http\Controllers;

use App\Models\UM_Contact;
use Illuminate\Http\Request;

class UMContactController extends Controller
{
	public function index(){
		$this->data['title'] = 'Kontak UM';

		return view('v_admin/shop/kontak/data', $this->data);
	}

	public function getKontakUM(){
		$table = $this->table_data('kontakUM');

		$data = [];
		$no   = $table['start'] + 1;

		foreach($table['list'] as $tmp){
			$row   = [];
			$row[] = $no;
			$row[] = '<a href="' .$tmp['link']. '" target="_blank" rel="noopener noreferrer">' .$tmp['social']. '</a>';
			$row[] = '<i class="' .$tmp['icon']. '" style="font-size: 2.5rem;"></i>';
			$row[] = '<div style="background:'.$tmp['color'].';" class="social-color"></div>';

			//kolom untuk button
			$row[] = '<a href="/Admin/kontakUM/view_edit_kontakUM?id='.$tmp['id'].'" class="btn btn-icon icon-left btn-primary m-1" 
						style="min-width: 5rem"><i class="fas fa-pen"></i>Edit</a>
						<button class="btn btn-icon icon-left btn-danger" id="delete_kontakUM" type="button" 
						data-id="'.$tmp['id'].'" data-social="'.$tmp['social'].'" style="min-width: 5rem">
						<i class="fas fa-times"></i>Hapus</button>';

			$data[] = $row;
			$no++;
		}

		$table['output']['data'] = $data;

		echo json_encode($table['output']);
		exit();
	}

	public function view_add_kontakUM(){
		$this->data['title']   = 'Tambah Kontak UM';
        $this->data['existed'] = [];

        foreach($this->m_kontakUM->getExistedContact() as $c){
            array_push($this->data['existed'], $c['icon']);
        }

		return view('v_admin/shop/kontak/add', $this->data);
	}

	public function add_kontakUM(){
        $social = $this->request->getVar('social');

		//validation 
		if(!$this->validate([
			'social' => [
				'rules'  => 'required|is_unique[kontak_um.social]',
				'errors' => [
					'required'  => 'Kontak masih kosong',
					'is_unique' => 'Kontak <strong>' .$social. '</strong> sudah ada',				
				]
			],
			'link' => [
				'rules'  => 'required|valid_url',
				'errors' => [
					'required'  => 'Link URL masih kosong',
					'valid_url' => 'Link URL tidak valid',				
				]
			],
			'icon' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Icon belum dipilih',
				]
			],
			'hex' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Hex masih kosong',			
				]
			],
		])) {
			return redirect()->back()->withInput();
		}

		$link = $this->request->getVar('link');
        $icon = $this->request->getVar('icon');
        $hex  = $this->request->getVar('hex');

		//process input data
		$this->m_kontakUM->save([
			'social' => $social,
			'link'   => $link,
			'icon' 	 => $icon,
			'color'  => $hex,
		]);

		//pesan yang ditampilkan apabila input success
		session()->setFlashdata('pesan', 'Kontak <strong>' .$social. '</strong> telah ditambahkan.');

		return redirect()->to('/Admin/KontakUM');
	}

	public function view_edit_kontakUM(){
		$id = $this->request->getVar('id');

		$this->data['kontakUM'] = $this->m_kontakUM->find($id);
		$this->data['title'] 	= 'Edit Kontak ' .ucwords($this->data['kontakUM']['social']);
        $this->data['existed'] 	= [];

        foreach($this->m_kontakUM->getExistedContact() as $c){
			if($c['icon'] == $this->data['kontakUM']['icon']){
				continue;
			}
            array_push($this->data['existed'], $c['icon']);
        }

		return view('v_admin/shop/kontak/edit', $this->data);
	}

	public function edit_kontakUM(){
		$id = $this->request->getVar('id');
        $social = $this->request->getVar('social');

		//validation 
		if(!$this->validate([
			'social' => [
				'rules'  => 'required|is_unique[kontak_um.social, kontak_um.id,'.$id.']',
				'errors' => [
					'required' => 'Kontak masih kosong',
					'is_unique' => 'Kontak <strong>' .$social. '</strong> sudah ada',				
				]
			],
			'link' => [
				'rules'  => 'required|valid_url',
				'errors' => [
					'required' => 'Link URL masih kosong',
					'valid_url' => 'Link URL tidak valid',				
				]
			],
			'icon' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Icon belum dipilih',
				]
			],
			'hex' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Hex masih kosong',			
				]
			],
		])) {
			return redirect()->back()->withInput();
		}

		$link = $this->request->getVar('link');
        $icon = $this->request->getVar('icon');
        $hex = $this->request->getVar('hex');

		//process input data
		$this->m_kontakUM->save([
			'id' => $id,
			'social' => $social,
			'link' => $link,
			'icon' => $icon,
			'color' => $hex,
		]);

		//pesan yang ditampilkan apabila input success
		session()->setFlashdata('pesan', 'Kontak <strong>' .$social. '</strong> telah diedit.');
		
		return redirect()->to('/Admin/KontakUM');
	}

	public function delete_kontakUM($id){
		$this->m_kontakUM->delete($id);
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
     * @param  \App\Models\UM_Contact  $uM_Contact
     * @return \Illuminate\Http\Response
     */
    public function show(UM_Contact $uM_Contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UM_Contact  $uM_Contact
     * @return \Illuminate\Http\Response
     */
    public function edit(UM_Contact $uM_Contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UM_Contact  $uM_Contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UM_Contact $uM_Contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UM_Contact  $uM_Contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(UM_Contact $uM_Contact)
    {
        //
    }
}
