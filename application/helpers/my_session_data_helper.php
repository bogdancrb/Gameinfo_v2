<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('getUserData'))
{
    function getUserData()
    {
        $ci = &get_instance();
        $user_data = $ci->session->all_userdata();

        if (!empty($user_data))
        {
            return $user_data;
        }

        return null;
    }
}

if ( ! function_exists('getUserId'))
{
    function getUserId()
    {
        $ci = &get_instance();
        $user_id = $ci->session->userdata('user_id');

        if (!empty($user_id))
        {
            return $user_id;
        }

        return null;
    }
}

if ( ! function_exists('getUserNickname'))
{
    function getUserNickname()
    {
        $ci = &get_instance();
        $user_nickname = $ci->session->userdata('user_nickname');

        if (!empty($user_nickname))
        {
            return $user_nickname;
        }

        return null;
    }
}

if ( ! function_exists('getUserEmail'))
{
    function getUserEmail()
    {
        $ci = &get_instance();
        $user_email = $ci->session->userdata('user_email');

        if (!empty($user_email))
        {
            return $user_email;
        }

        return null;
    }
}

if ( ! function_exists('getUserCountry'))
{
    function getUserCountry()
    {
        $ci = &get_instance();
        $user_country = $ci->session->userdata('user_country');

        if (!empty($user_country))
        {
            return $user_country;
        }

        return null;
    }
}

if ( ! function_exists('isUserAdmin'))
{
    function isUserAdmin()
    {
        $ci = &get_instance();
        $is_admin = $ci->session->userdata('isAdmin');

        if (!empty($is_admin))
        {
            return $is_admin;
        }

        return false;
    }
}

if ( ! function_exists('isUserLogged'))
{
    function isUserLogged()
    {
        $ci = &get_instance();
        $is_logged = $ci->session->userdata('isLogged');

        if (!empty($is_logged))
        {
            return $is_logged;
        }

        return false;
    }
}

if ( ! function_exists('getAccessLevel'))
{
    function getAccessLevel()
    {
        $ci = &get_instance();
        $user_access_level = $ci->session->userdata('user_access_level');

        if (!empty($user_access_level))
        {
            return $user_access_level;
        }

        return false;
    }
}

if ( ! function_exists('clear_session_data'))
{
    function clear_session_data()
    {
        $ci = &get_instance();
        $ci->session->sess_destroy();
    }
}