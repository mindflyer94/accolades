<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('M_project');
	}

	function __destruct()
	{
		// $this->db->close();
	}

	public function index()
	{
		$data['project'] = $this->M_project->get_project(); //print_r($data);die();

		$reg['project_id'] = $this->security->xss_clean($this->input->post('project_name'));
		$reg['taskname'] = $this->security->xss_clean($this->input->post('task'));
		$reg['hour'] = $this->security->xss_clean($this->input->post('hour'));
		$reg['date'] = $this->security->xss_clean($this->input->post('date'));
		$reg['description'] = $this->security->xss_clean($this->input->post('description'));
		$reg['btnsubmit'] = $this->security->xss_clean($this->input->post('btnsubmit'));
		if ($reg['btnsubmit'] == "Add") {
			$data['result'] = $this->M_project->insert_timeentry($reg);
		}
		$data['timeentry'] = $this->M_project->get_timeentry(); //print_r($data['timeentry']);die();
		$this->load->view('Timeentry', $data);
	}
	public function get_task($str)
	{
		$this->data['task'] = $this->M_project->get_task($str);
		// print_r($this->data);die();
		echo json_encode($this->data);
	}

	function get_project()
	{ //echo "asdasdsa";die();
		//print_r($data['result']);die();
		$reg['p_id'] = $this->security->xss_clean($this->input->post('p_id'));
		$reg['project_name'] = $this->security->xss_clean($this->input->post('project_name'));
		$reg['status'] = $this->security->xss_clean($this->input->post('status'));
		$reg['btnsubmit'] = $this->security->xss_clean($this->input->post('btnsubmit'));
		if ($reg['btnsubmit'] == 'update') {
			$data['upd_project'] = $this->M_project->update_project($reg);
		}
		$data['result'] = $this->M_project->get_full_project();
		$this->load->view('project', $data);
	}
	function view_task()
	{

		$reg['t_id'] = $this->security->xss_clean($this->input->post('t_id'));
		$reg['p_id'] = $this->security->xss_clean($this->input->post('project_name'));
		$reg['taskname'] = $this->security->xss_clean($this->input->post('task'));
		$reg['status'] = $this->security->xss_clean($this->input->post('status'));
		$reg['btnsubmit'] = $this->security->xss_clean($this->input->post('btnsubmit'));
		if ($reg['btnsubmit'] == 'update') {
			//print_r($reg);die();
			$data['upd_project'] = $this->M_project->update_task($reg);
		}
		$data['result'] = $this->M_project->get_full_task(); //print_r($data['timeentry']);die();
		$this->load->view('task', $data);
	}
	function get_timeentry()
	{
		$data['result'] = $this->M_project->get_full_timeentry(); //print_r($data['result']);die();
		$this->load->view('time_entry_report', $data);
	}
	function edit_project($id = "")
	{
		$id = $_GET['id'];
		$data['edit_project'] = $this->M_project->edit_project($id); //print_r($data['edit_project']);die();
		//$data['project'] = $this->M_project->get_project();
		$this->load->view('edit_project', $data);
	}
	function delete_project($id = "")
	{
		$id = $_GET['id'];
		$data['message'] = $this->M_project->delete_project($id); // print_r($data['message']);die();
		$data['result'] = $this->M_project->get_full_project();
		$this->load->view('project', $data);
	}
	function edit_task($id = "")
	{
		$id = $_GET['id'];
		$data['edit_task'] = $this->M_project->edit_task($id); //print_r($data['edit_task']);die();
		$data['project'] = $this->M_project->get_project();
		$this->load->view('edit_task', $data);
	}
	function delete_task($id = "")
	{
		$id = $_GET['id'];
		$data['message'] = $this->M_project->delete_task($id); //print_r($data['edit_project']);die();
		$data['result'] = $this->M_project->get_full_task();
		$this->load->view('task', $data);
	}
	function search()
	{
		$projectname = $_GET['projectname'];
		$data['result'] = $this->M_project->search($projectname);
		echo json_encode($data['result']);
	}
}
