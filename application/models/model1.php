<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model1 extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function getVals($username)
	{
		$query = $this->db->get_where('trial', array('username' => $username));

		return $query->result();
	}
}