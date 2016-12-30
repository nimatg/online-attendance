<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class attend_emp extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('attend_model');
    $this->load->model('admlogin_model');
		$this->load->library('session');
        $userdata = $this->session->userdata('userdata');
        if($userdata['loggedIn']!=1)
        {
            redirect('login_user');
        }
	}

	public function index()
	{
		$this->load->view('employee_dashboard/dashboard');
	}

	public function attend_employee()
  { 
    // $gps['gps']=$this->admlogin_model->get_gps();
    $input = array(
                    'latt' => $this->input->post('latt'),
                    'long' => $this->input->post('long'),
                );

    $res = $this->admlogin_model->get_gps();
    // $max_latt=27.7449;
    // $min_latt=27.7447;
    // $max_long=85.3355;
    // $min_long=85.3353;

    // $latt =$_POST["latt"];
    // $long =$_POST["long"];
    // if ( ($latt < $max_latt && $latt > $min_latt)  && ( $long > $min_long && $long < $max_long)) {
    //   // echo "success";
    if( $res = $input ){
  if($_POST){
    $this->form_validation->set_rules('date', 'Attendance Date', 'required');
    $this->form_validation->set_rules('time', 'Entrance Time', 'required');
    $this->form_validation->set_rules('status', 'Attendance status', 'required');

    if($this->input->post('btnattend'))
    {
      if($this->form_validation->run()==false)
        {
        redirect('login_emp/attendance');
    
        }
        else
        {
          $attenddata = array(
          'emp_id' =>$this->input-> post('id'),
          'date' =>$this->input-> post('date'),
          'ent_time' =>$this->input-> post('time'),
          'status' =>$this->input-> post('status'),
      );
    $insert = $this->attend_model->attend_employee($attenddata);
    if ($insert)
      {
        redirect('login_emp/attendance');	
         }
       
        }
    }
  }
  }
  else{
      echo "unsussfull";
    }
}
public function view_notice(){
      $noticedata['notes']=$this->attend_model->getAllnote();
      $this->load->view('employee_dashboard/viewnotice', $noticedata);
  }
public function view_attendrecord($id){
      $noticedata['records']=$this->attend_model->getAllattendrecord($id);
      $this->load->view('employee_dashboard/viewattendrecord', $noticedata);
  }
  public function take_leave()
  {
  if($_POST){
    $this->form_validation->set_rules('fromdate', 'Leave Date(From)', 'required');
    $this->form_validation->set_rules('todate', 'Leave Date(To)', 'required');
    $this->form_validation->set_rules('title', 'Leave Title', 'required');
    $this->form_validation->set_rules('description', 'Leave Description', 'required');


    if($this->input->post('btnleave'))
    {
      if($this->form_validation->run()==false)
        {
        redirect('login_emp/leave');
    
        }
        else
        {
          $leavedata = array(
          'emp_id' =>$this->input-> post('id'),
          'leavestart_date' =>$this->input-> post('fromdate'),
          'leaveend_date' =>$this->input-> post('todate'),
          'leave_title' =>$this->input-> post('title'),
          'leave_desc' =>$this->input-> post('description'),
      );
    $insert = $this->attend_model->leave_employee($leavedata);
    if ($insert)
      {
        redirect('login_emp/leave'); }
        else{
          echo "Employee is not added";
          } 
        }
    }

  }
  else{
       redirect('login_emp/attendance');
    }
}
public function view_leave($id){
   
      $leavedata['leaves']=$this->attend_model->getAllleaverecord($id);
      $this->load->view('employee_dashboard/viewleave', $leavedata);
  }
}