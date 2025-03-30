<?php

namespace App\Http\Controllers;

use App\Models\Research;
use Illuminate\Http\Request;

class ResearchController extends Controller
{
	public function index()
	{
		$researchProjects = Research::all();
		return view('research', compact('researchProjects'));
	}
}
