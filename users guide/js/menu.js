function create_menu(basepath)
{
	var base = (basepath == 'null') ? '' : basepath;

	document.write(
		'<ul id="menu">' +
			'<li><a href="#" class="drop">Table of Contents</a>' +
				'<div class="dropdown_4columns">' +	
					'<div class="col_4">' +
						'<h2>Table of Contents</h2>' +
					'</div>' +
					
					'<div class="col_1">' +
						'<h3>Basic Info</h3>' +
						'<ul>' +
							'<li><a href="' + basepath + '">User Guide Home</a></li>' +
							'<li><a href="' + basepath + '">Server Requirement</a></li>' +
							'<li><a href="' + basepath + '">License Agreement</a></li>' +
							'<li><a href="' + basepath + '">Change Log</a></li>' +
						'</ul>' +
					'</div>' +
			
					'<div class="col_1">' +
						'<h3>Installation</h3>' +
						'<ul>' +
							'<li><a href="' + basepath + '">Downloading EasyDev</a></li>' +
							'<li><a href="' + basepath + '">Installation Instruction</a></li>' +
							'<li><a href="' + basepath + '">Upgrading from a Previous Version</a></li>' +
						'</ul>' +
					'</div>' +
			
					'<div class="col_1">' +
						'<h3>Introduction</h3>' +
						'<ul>' +
							'<li><a href="' + basepath + '">Getting Started</a></li>' +
							'<li><a href="' + basepath + '">Supported Features</a></li>' +
							'<li><a href="' + basepath + '">Application Flow Chart</a></li>' +
							'<li><a href="' + basepath + '">MVC</a></li>' +
						'</ul>' +
					'</div>' +
			
					'<div class="col_1">' +
						'<h3>Tutorial</h3>' +
						'<ul>' +
							'<li><a href="' + basepath + 'tutorial/controllers.html">Controllers</a></li>' +
							'<li><a href="' + basepath + 'tutorial/models.html">Models</a></li>' +
                            '<li><a href="' + basepath + 'tutorial/views.html">Views</a></li>' +
                            '<li><a href="' + basepath + 'tutorial/exampleofmvc.html">An Example of MVC</a></li>' +
						'</ul>' +
					'</div>' +
					
					'<div class="col_1">' +
						'<h3>General Topics</h3>' +
						'<ul>' +
							'<li><a href="' + basepath + 'general_topics/easydevurls.html">EasyDev URLs</a></li>' +
							'<li><a href="' + basepath + '">Reserved Names</a></li>' +
							'<li><a href="' + basepath + '">Using EasyDev Libraries</a></li>' +
							'<li><a href="' + basepath + '">Create Your Own Libraries</a></li>' +
							'<li><a href="' + basepath + '">Auto-Loading Resources</a></li>' +
							'<li><a href="' + basepath + 'general_topics/globalfunctions.html">Global Functions</a></li>' +
							'<li><a href="' + basepath + 'general_topics/urirouting.html">URI Routing</a></li>' +
							'<li><a href="' + basepath + '">Error Handling</a></li>' +
							'<li><a href="' + basepath + '">Managing Applications</a></li>' +
						'</ul>' +
					'</div>' +
					
					'<div class="col_1">' +
						'<h3>Class Reference</h3>' +
						'<ul>' +
							'<li><a href="' + basepath + '">Cookie Class</a></li>' +
							'<li><a href="' + basepath + '">Download Class</a></li>' +
							'<li><a href="' + basepath + '">$Email Class</a></li>' +
							'<li><a href="' + basepath + '">Input Class</a></li>' +
							'<li><a href="' + basepath + '">$Job Scheduler Class</a></li>' +
							'<li><a href="' + basepath + 'class_reference/language.html">Language Class</a></li>' +
							'<li><a href="' + basepath + '">reCaptcha Class</a></li>' +
							'<li><a href="' + basepath + '">Security Class</a></li>' +
							'<li><a href="' + basepath + '">Session Class</a></li>' +
							'<li><a href="' + basepath + '">$Upload Class</a></li>' +
							'<li><a href="' + basepath + '">$Xml Class</a></li>' +
						'</ul>' +
					'</div>' +
					
				'</div>' +
			'</li>' +
		'</ul>');
}