<?php

function check_login()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        redirect('auth');
    } else {
        $level = $ci->session->userdata('level');
        $userAccess = $ci->db->get_where('petugas', ['level' => $level]);

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}
