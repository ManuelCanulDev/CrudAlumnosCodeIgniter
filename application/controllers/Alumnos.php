<?php 

class Alumnos extends CI_Controller{

	public function _construct(){
		parent::_construct();
		$this->load->model('Alumno');
	}

	//FUNCION QUE CARGA TODOS LOS ALUMNOS CUANDO ESTEMOS EN EL INDEX
	public function index(){

		

		$data['alumnos'] = $this->Alumno->getAlumno();
		$data['title'] = "Inicio";
		$data['main_content'] = "Inicio";

		if($this->uri->segment(3) != ''){
			$id = $this->uri->segment(3);
			$data['alumno_actualizar'] = $this->Alumno->traerAlumno($id);
		}

		$this->load->view('Alumno/index',$data);
	}

	//FUNCION QUE CARGA LA VISTA CON LOS DATOS DEL ALUMNO A VER
	public function VerAlumno(){
		# code...
		
		$id = $this->uri->segment(3);
		$data['alumno_a_ver'] = $this->Alumno->traerAlumno($id);
		$this->load->view('Alumno/view',$data);
	}

	//FUNCION QUE CARGA LA VISTA CON LOS DATOS DEL ALUMNO A EDITAR
	public function editarAlumno(){
		# code...
		
		$id = $this->uri->segment(3);
		$data['alumno_a_editar'] = $this->Alumno->traerAlumno($id);
		$this->load->view('Alumno/update',$data);
	}

	//FUNCION QUE CAMBIA LA VISTA CON EL FORMULARIO PARA AGREGAR UN ALUMNO
	public function confirmarAgregarAlumno(){
		# code...
		$this->load->view('Alumno/create');
	}

	//FUNCION QUE AGREGA UN ALUMNO DESDE EL FORMULARIO EN confirmarAgregarAlumno
	public function insertarAlumno(){
		
		$alumno = array(
			'id_alumno' => null,
			'nombre_alumno' => $this->input->post('nombre_alumno'),
			'apellidos_alumno' => $this->input->post('apellidos_alumno'),
			'matricula_alumno' => $this->input->post('matricula_alumno')
		);

		
		if($this->Alumno->insertAlumno($alumno)){
			redirect('Alumnos');
		}
	}

	//FUNCION QUE ACTUALIZA UN ALUMNO DESDE EL FORMULARIO EN editarAlumno
	public function actualizarAlumno(){
		$alumno = array(
			'nombre_alumno' => $this->input->post('nombre_alumno'),
			'apellidos_alumno' => $this->input->post('apellidos_alumno'),
			'matricula_alumno' => $this->input->post('matricula_alumno')
		);

		$id = $this->input->post('id_alumno');

		

		if($this->Alumno->updateAlumno($id,$alumno)){
			redirect('Alumnos');
		}
	}

	//FUNCION QUE CAMBIA LA VISTA CON LA PREGUNTA PARA ELIMINAR UN ALUMNO
	public function confirmarEliminarAlumno(){
		# code...
		
		$id = $this->uri->segment(3);
		$data['alumno_a_eliminar'] = $this->Alumno->traerAlumno($id);
		$this->load->view('Alumno/delete',$data);
	}

	//FUNCION QUE ELIMINA UN ALUMNO DESDE EL FORMULARIO EN confirmarEliminarAlumno
	public function eliminarAlumno(){
		$id = $this->uri->segment(3);
		
		if($this->Alumno->deleteAlumno($id)){
			redirect('Alumnos');
		}
	}

	public function add(){
		# code...
		$this->load->library("form_validation");
		$this->load->helper("form");
		$data["titulo"] = "Agregar Alumno";

		$this->form_validation->set_rules("nombre","nombre","required");
		$this->form_validation->set_rules("apellido","apellido","required");
		$this->form_validation->set_rules("matricula","matricula","required");

		if($this->form_validation->run() == FALSE){
			$this->load->view("Alumno/add",$data);
		}else{
			$this->Alumno->setNews();
			redirect('Alumnos');
		}
	}

	public function update($id = null){
		# code...
		$this->load->library("form_validation");
		$this->load->helper("form");

		if($id != null){
			$data['dato'] = $this->Alumno->traerAlumno($id);
			$this->form_validation->set_rules("nombre_alumno","nombre_alumno","required");
			$this->form_validation->set_rules("apellidos_alumno","apellidos_alumno","required");
			$this->form_validation->set_rules("matricula_alumno","matricula_alumno","required");
			if($this->form_validation->run() == FALSE){
			$this->load->view("Alumno/update",$data);
			}else{
				
				$this->Alumno->updateAlumno($id);
				redirect('Alumnos');
			}
		}else{
			$this->Alumno->updateNews($id);
			redirect("Alumnos");
		}

	}

}

?>


