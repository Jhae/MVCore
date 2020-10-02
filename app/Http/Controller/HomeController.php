<?php

namespace MVCore\Http\Controller;
use MVCore\Http\Router;

class HomeController extends Controller
{
    const GET_OPERATIONS = ['index'];
    const POST_OPERATIONS = [];
    const DEFAULT_OPERATION = 'index';

    function index()
    {

        $this->view("indexView", []);
    }
}

