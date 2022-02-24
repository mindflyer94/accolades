<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class M_project extends CI_Model
{

    function get_project()
    { //echo "sadasdas";die();
        $this->db->select('id,name');
        $this->db->from('project');
        $this->db->where('status', true);
        $this->db->order_by('name');
        $query = $this->db->get(); //echo $this->db->last_query();exit;
        return $query->result_array();
    }
    function get_task($str)
    {
        $this->db->select('id,taskname');
        $this->db->from('task');
        $this->db->where('status', true);
        $this->db->where('project_id', $str);
        $this->db->order_by('taskname');
        $query = $this->db->get(); //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->result();
    }
    function insert_timeentry($reg)
    {
        // print_r($reg);die();
        $data = array(
            "project_id" => $reg['project_id'],
            "task_id" => $reg['taskname'],
            "time_hour" => $reg['hour'],
            "time_date" => $reg['date'],
            "description" => $reg['description']

        );
        $this->db->insert('time_entry', $data);
    }

    function get_timeentry()
    {
        $this->db->select('te.time_hour,te.time_date,t.taskname as task,p.name as project,te.description');
        $this->db->from('time_entry as te');
        $this->db->join('task as t', 't.id= te.task_id');
        $this->db->join('project as p', 'p.id= te.project_id');
        $this->db->order_by('te.id');
        $query = $this->db->get(); //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->result();
    }
    function get_full_project()
    {
        $this->db->select('*');
        $this->db->from('project');
        $this->db->order_by('id');
        $query = $this->db->get(); //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->result();
    }
    function get_full_task()
    {
        $this->db->select('t.*,p.name');
        $this->db->from('task as t');
        $this->db->join('project as p', 'p.id= t.project_id');

        $query = $this->db->get(); //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->result();
    }
    function get_full_timeentry()
    {
        $this->db->select('t.taskname,p.name,sum(te.time_hour) as hour');
        $this->db->from('time_entry as te');
        $this->db->join('project as p', 'p.id= te.project_id');
        $this->db->join('task as t', 't.id= te.task_id');
        $this->db->group_by('p.name,t.taskname');
        $this->db->order_by('te.project_id');
        $query = $this->db->get(); //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->result();
    }
    function search($pnmae)
    {
        $this->db->select('t.taskname,p.name,sum(te.time_hour) as hour');
        $this->db->from('time_entry as te');
        $this->db->join('project as p', 'p.id= te.project_id');
        $this->db->join('task as t', 't.id= te.task_id');
        $this->db->where('lower(p.name) like ', '%' . strtolower($pnmae) . '%');
        $this->db->group_by('p.name,t.taskname');
        $this->db->order_by('te.project_id');
        $query = $this->db->get(); //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->result();
    }
    function edit_project($id)
    {
        $this->db->select('*');
        $this->db->from('project');
        $this->db->where('id', $id);
        $query = $this->db->get(); //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->result();
    }
    function update_project($reg)
    {
        $data = array(
            "status" => $reg['status'],
            "name" => $reg['project_name']

        );
        $this->db->where('id', $reg['p_id']);
        $this->db->update('project', $data);
    }

    function delete_project($id)
    {

        $this->db->select('*');
        $this->db->from('task');
        $this->db->where('project_id', $id);
        $query = $this->db->get(); //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return 0;
        else {
            $this->db->where('id', $id);
            $this->db->delete('project');
            return 1;
        }
    }
    function edit_task($id)
    {

        $this->db->select('*');
        $this->db->from('task');
        $this->db->where('id', $id);
        $query = $this->db->get(); //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->result();
    }
    function update_task($reg)
    {
        $data = array(
            "status" => $reg['status'],
            "project_id" => $reg['p_id'],
            "taskname" => $reg['taskname']
        );
        $this->db->where('id', $reg['t_id']);
        $this->db->update('task', $data);
    }
    function delete_task($id)
    {


        $this->db->select('*');
        $this->db->from('time_entry');
        $this->db->where('task_id', $id);
        $query = $this->db->get(); //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return 0;
        else {
            $this->db->where('id', $id);
            $this->db->delete('project');
            return 1;
        }
    }
}//class
