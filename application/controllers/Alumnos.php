<?php 

class Alumnos extends CI_Controller{

	//FUNCION QUE CARGA TODOS LOS ALUMNOS CUANDO ESTEMOS EN EL INDEX
	public function index(){

		$this->load->model('Alumno');

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
		$this->load->model('Alumno');
		$id = $this->uri->segment(3);
		$data['alumno_a_ver'] = $this->Alumno->traerAlumno($id);
		$this->load->view('Alumno/view',$data);
	}

	//FUNCION QUE CARGA LA VISTA CON LOS DATOS DEL ALUMNO A EDITAR
	public function editarAlumno(){
		# code...
		$this->load->model('Alumno');
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

		$this->load->model('Alumno');
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

		$this->load->model('Alumno');

		if($this->Alumno->updateAlumno($id,$alumno)){
			redirect('Alumnos');
		}
	}

	//FUNCION QUE CAMBIA LA VISTA CON LA PREGUNTA PARA ELIMINAR UN ALUMNO
	public function confirmarEliminarAlumno(){
		# code...
		$this->load->model('Alumno');
		$id = $this->uri->segment(3);
		$data['alumno_a_eliminar'] = $this->Alumno->traerAlumno($id);
		$this->load->view('Alumno/delete',$data);
	}

	//FUNCION QUE ELIMINA UN ALUMNO DESDE EL FORMULARIO EN confirmarEliminarAlumno
	public function eliminarAlumno(){
		$id = $this->uri->segment(3);
		$this->load->model('Alumno');
		if($this->Alumno->deleteAlumno($id)){
			redirect('Alumnos');
		}
	}

}

?>