<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Maps extends MX_Controller
{

function __construct() {
parent::__construct();
}
function index(){
        $this->load->library('googlemaps');
        
        $config['center'] = '37.4419, -122.1419';
        $config['zoom'] = 15;
        $this->googlemaps->initialize($config);
        $lat = 37.4415;
        $long = -122.1419;
        for ($x = 0; $x <= 1; $x++) {
            $marker = array();
            
            $lat = $lat+0.001;
            $long = $long+0.001;
            $marker['position'] = $lat.','.$long;
            $marker['infowindow_content'] = '<a href = "Chef/dashboard">Hey, Check out my profile</a>';
            $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|000000';
            $marker1 = array();
            $marker1['position'] = '38.4419, -122.1419';
            $marker1['infowindow_content'] = '<a href = "google.com">Hey, Check out my profile</a>';
            $marker1['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|000000';

            $this->googlemaps->add_marker($marker);    
        } 
        $circle = array();
        $circle['center'] = '37.4419, -122.1419';
        $circle['radius'] = '500';
        $this->googlemaps->add_circle($circle);

        $data['map'] = $this->googlemaps->create_map();
        $data['view_file'] = 'maps_view';
        $this->load->module("Main_template");
        $this->main_template->index($data);
        
}
}