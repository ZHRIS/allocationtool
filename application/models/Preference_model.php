<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Preference Model
 *
 * @author
 */
class Preference_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get($id)
    {
        $this->db->from('preference');
        $this->db->where('preference_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_total_count()
    {
        $this->db->distinct();
        $this->db->from('preference');
        $query = $this->db->get();
        return $query->num_rows();

    }

    public function get_all()
    {
        $this->db->distinct();
        $this->db->from('preference');
        $query = $this->db->get();
        return $query->result();
    }

    public function save($graduate_id, $demand_location_id)
    {
        $this->graduate_id = $graduate_id;
        $this->demand_location_id = $demand_location_id;
        $this->db->insert('preference', $this);
    }

    public function update($graduate_id, $demand_location_id)
    {
        $this->graduate_id = $graduate_id;
        $this->demand_location_id = $demand_location_id;
        $this->db->where('graduate_id', $graduate_id);
        $this->db->where('demand_location_id', $demand_location_id);
        $this->db->update('preference', $this);
    }

    function delete($id)
    {
        $this->db->where('preference_id', $id);
        $this->db->delete('preference');
    }

    public function get_preference_list($id)
    {
        $this->db->distinct();
        $this->db->from('preference');
        $this->db->where('graduate_id', $id);
        $this->db->join('demand_location', 'preference.demand_location_id = demand_location.demand_location_id');
        $this->db->order_by('preference_id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    function get_row_count($id)
    {
        $this->db->distinct();
        $this->db->from('preference');
        $this->db->where('demand_location_id', $id);
        $query = $this->db->get();
        return $query->num_rows();

    }

    function get_preference($graduate_id, $demand_location_id)
    {
        $this->db->from('preference');
        $this->db->where('graduate_id', $graduate_id);
        $this->db->where('demand_location_id', $demand_location_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function check_preference($graduate_id, $demand_location_id)
    {
        if (is_null($this->get_preference($graduate_id, $demand_location_id))) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function get_preference_choice($graduate_id, $demand_location_id)
    {
        $numberOfPreferenceAllowed = $this->setting_model->get_number_of_preferences_allowed();
        $row = $numberOfPreferenceAllowed + 1;
        foreach ($this->get_preference_list($graduate_id) as $p) {
            if ($p->demand_location_id == $demand_location_id) {
                return ($row - $numberOfPreferenceAllowed);
            }
            $numberOfPreferenceAllowed = $numberOfPreferenceAllowed - 1;
        }
        return $numberOfPreferenceAllowed;
    }

    public function get_preference_weight($graduate_id, $demand_location_id)
    {
        $preferences = $this->get_preference_list($graduate_id);
        $numberOfPreferenceAllowed = $this->setting_model->get_number_of_preferences_allowed();
        foreach ($preferences as $i => $item) {
            if ($item->demand_location_id == $demand_location_id) {
                return $numberOfPreferenceAllowed;
            }
            $numberOfPreferenceAllowed = $numberOfPreferenceAllowed - 1;
        }
    }

    public function get_demand_location_ids()
    {
        $this->db->distinct();
        $this->db->select('demand_location_id');
        $this->db->from('preference');
        $query = $this->db->get();
        return $query->result();
    }


    public function get_number_of_top_choices_selection($demand_location_id)
    {//at least picked as top choice
        $number_of_selections = 0;
        foreach ($this->graduate_model->get_all() as $graudate) {
            $numberOfPreferenceAllowed = $this->setting_model->get_number_of_preferences_allowed();
            if ($this->get_preference_weight($graudate->graduate_id, $demand_location_id) == $numberOfPreferenceAllowed) {
                $number_of_selections = $number_of_selections +1;
            }
        }
        return $number_of_selections;
    }

    public function get_number_of_choices_selection_more_than_one($demand_location_id)
    {//at least picked once
        $number_of_selections = 0;
        foreach ($this->graduate_model->get_all() as $graudate) {
            $numberOfPreferenceAllowed = $this->setting_model->get_number_of_preferences_allowed();
            if ($this->get_preference_weight($graudate->graduate_id, $demand_location_id) > 0) {
                $number_of_selections = $number_of_selections +1;
            }
        }
        return $number_of_selections;
    }

    function deleteAll() {
        $this->db->empty_table('preference');
    }
}
