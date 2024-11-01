		jQuery(document).ready(function(){
			
			/* user location */
			var loc = plugin_data.user_loc;
			
			/* enable analog */
			var an_clock_type = plugin_data.an_clock_type;
			
			/* enable digital */
			var dg_clock_type = plugin_data.dg_clock_type;
			
			/* enable date */
			var dt_clock_type = plugin_data.dt_clock_type;
			
			/* time format */
			var time_format = plugin_data.time_format;
			
			/* user title */
			var custom_title = plugin_data.custom_title;
			
			
			/* enable meridiem */
			var clock_meridiem = plugin_data.clock_meridiem;
			
			
			/* analog model */
			var analog_model = plugin_data.analog_model;
			
			
			/* enable disable meridiem*/
			
			if(clock_meridiem == 'null'){
				
				
			}
			/*get user location*/
			
			if(loc == 'on'){
			jQuery.get("http://ipinfo.io", function (response) {
				jQuery(".jcgmt-lbl").html(response.city + ", " + response.country);

			}, "jsonp");
			
			}
			
			/*show title*/
			if(custom_title != ''){
				jQuery('#title').append(custom_title);
			}
			/* show clock */
			
			if(analog_model == 'Mobel 1'){
                jQuery('#clock_hou').jClocksGMT(
                {
                    title: '', 
                    offset: '-6'
                });
			}
			
			if(analog_model == 'Mobel 2'){
                jQuery('#clock_india').jClocksGMT(
                {
                    title: '', 
                    offset: '+5.5', 
                    dst: false, 
                    skin: 2, 
                    
                });
			}
			
			if(analog_model == 'Mobel 3'){
                jQuery('#clock_korea').jClocksGMT(
                {
                    title: '', 
                    offset: '+8', 
                    skin: 3, 
                    date: true
                });
			}	
				
			if(analog_model == 'Mobel 4'){
                jQuery('#clock_uk').jClocksGMT(
                {   
                    date: true, 
                     
                    skin: 4
                });
			}
			if(analog_model == 'Mobel 5'){
				jQuery('#clock_tokyo').jClocksGMT(
                {
                    title: '',
                    offset: '+9',
                    skin: 5
                });
			}
            });
