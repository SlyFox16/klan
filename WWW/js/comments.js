function fnApplyTag(sTag)
		{
			var oSelTxt = document.getElementById('f1');
			var start = oSelTxt.selectionStart;
			var end = oSelTxt.selectionEnd;
			oSelTxt.focus();

			var sSelTxt = oSelTxt.value;

			oTag="[";
			cTag="[";

			switch(sTag)
			{
				case "bold": oTag+="b]"; cTag+="/b]"; break;
				case "quote": oTag+="quote]"; cTag+="/quote]"; break;
				case "italic": oTag+="italic]"; cTag+="/italic]"; break;
			}
			if (sSelTxt){
			oSelTxt.value = oSelTxt.value.substring(0, start) + oTag + oSelTxt.value.substring(start, end) + cTag + oSelTxt.value					            .substring(end);

			//oSelTxt.selectionStart = (oSelTxt.value.substring(0, start) + oTag).length;
			//oSelTxt.selectionEnd = oSelTxt.selectionStart + oSelTxt.value.substring(start, end).length;
			}
			else
			{
				oSelTxt.value = oTag+cTag;
			}
			check();
		}
		
		function fnPrompt()
		{
			var oSelTxt = document.getElementById('f1');
			var start = oSelTxt.selectionStart;
			var end = oSelTxt.selectionEnd;
			oSelTxt.focus();

			var url = prompt("Введите адрес ссылки", "http://");
	
			var reg = /null/g;
			if (reg.test(url)) return;
			
			if ((url)&&(url != "") && (start != end))
			{
				oSelTxt.value = oSelTxt.value.substring(0, start) + "[URL="+url+"]" + oSelTxt.value.substring(start, end) + "[/URL]" + oSelTxt.value.substring(end);
			}
			else
			{
				var url_text = prompt("Введите текст ссылки", "");
				var reg = /null/g;
				if (reg.test(url_text))  return;

				oSelTxt.value = oSelTxt.value.substring(0, start) + "[URL="+url+"]" + url_text + "[/URL]" + oSelTxt.value.substring(end);
			}
			check();
		}
		
		function selectFn(id, flag)
		{
			var sel = document.getElementById(id);
			var oSelTxt = document.getElementById('f1');
			var start = oSelTxt.selectionStart;
			var end = oSelTxt.selectionEnd;
			var sSelTxt = oSelTxt.value;
			oSelTxt.focus();
			
			var index = sel.selectedIndex;
			var value = sel.options[index].value;
			
			oTag='[';
			cTag='[';
			
			if (flag)
			{
				oTag += 'color='+value+']';
				cTag += '/color]';
			}
			else
			{
				oTag += 'size='+value+']';
				cTag += '/size]';
			}
			
			if (sSelTxt){
			oSelTxt.value = oSelTxt.value.substring(0, start) + oTag + oSelTxt.value.substring(start, end) + cTag + oSelTxt.value					            .substring(end);

			//oSelTxt.selectionStart = (oSelTxt.value.substring(0, start) + oTag).length;
			//oSelTxt.selectionEnd = oSelTxt.selectionStart + oSelTxt.value.substring(start, end).length;
			}
			else
			{
				oSelTxt.value = oTag+cTag;
			}
			sel.options[0].selected = true;
			check();
		}
		
		function show(i)
	  	{
			 var oSelTxt = document.getElementById('f1');
			 var start = oSelTxt.selectionStart;
			 oSelTxt.focus();
			 
			 oSelTxt.value = oSelTxt.value.substring(0, start) + i + oSelTxt.value.substring(start);
			 check();
	  	}
		
		function showSmiles()
		{
			$("#smiles").slideToggle('slow');
		}
		
		function check()
		{
			if(document.getElementById('f1').value != '')
			{
				document.getElementById('submit').disabled=false;
				document.getElementById('reset').disabled=false;
			}
			else
			{
				document.getElementById('submit').disabled=true;
				document.getElementById('reset').disabled=true;
			}
		}
		
		function resetf()
		{
			document.getElementById('f1').value = '';
			document.getElementById('submit').disabled=true;
			document.getElementById('reset').disabled=true;
		}
		
		function addCom()
		{
			var input = document.getElementById('f1').value;
			$.post(
					"helpers/addComment.php",
					"comtext="+input,
					function(data)
					{
						$('#artCom').empty().append(data);
					},
					"html"
		    );
			document.getElementById('f1').value = '';
			document.getElementById('artCom').children[0].scrollIntoView();
			check();
		}
		
		function changePage(ar, page)
		{
			$.get(
				"helpers/addComment.php",
				"ar="+ar+"&page="+page,
				function(data)
				{
					$('#artCom').empty().append(data);
				},
				"html"
		   	);
		}
		
	function tanksClear(code){return false;}
		
		function selectTank()
		{
			var sel = document.getElementById('level9-10');
			var index = sel.selectedIndex;
			var value = sel.options[index].value;
			var text = document.getElementById('tanks').value;
			var arr = text.split('\n');
			arr = arr.length;
			document.getElementById('tanks').value += arr + '. ' + value + '\n';
			sel.options[0].selected = true;
		}
		
		$(document).ready(function()
		{
			$('#rem').mousedown(function()
			{
				$('#rem').css('background-color', '#ccc');
				var text = document.getElementById('tanks').value;
				var arr = text.split('\n');
				var end = arr.length - 2;
				document.getElementById('tanks').value = '';
				for(var i = 0; i < end; i++)
					document.getElementById('tanks').value += arr[i] + '\n';
			});	
			$('#rem').mouseup(function()
			{
				$('#rem').css('background-color', '#fff');
			});
			
			$('#submit').mousedown(function()
			{
				$('#submit').css('background-color', '#ccc');
			});	
			$('#submit').mouseup(function()
			{
				$('#submit').css('background-color', '#fff');
			});
		});
		
		function proverka(input) { 
			var value = input.value; 
			var rep = /[-\.;":'a-zA-Zа-яА-Я]/g; 
			if (rep.test(value)) { 
				value = value.replace(rep, ''); 
				input.value = value; 
    		} 
		} 
		
		function able(input, ch1, ch2)
		{
			if(input.checked)
			{
				document.getElementById(ch1).disabled=false;
				document.getElementById(ch2).disabled=false;
			}
			else
			{
				document.getElementById(ch1).disabled=true;
				document.getElementById(ch2).disabled=true;
			}
		}
		
		function ableCon(input, ch1)
		{
			if(input.checked)
			{
				document.getElementById(ch1).disabled=false;
			}
			else
			{
				document.getElementById(ch1).disabled=true;
			}
		}
		
		function showForm()
		{
			$('#castField').fadeIn('slow');
		}
		
		function addCast()
		{
			var tempEr = '';
			$.post(
					"helpers/Cast.php",
					$('form').serialize(),
					function(xml)
					{
						$(xml).find('error').each(function(){
							tempEr += '<span style="color:#F00; font-weight:bold;">'+$(this).text()+'</span><br>';
						});
						$('#errorAns').empty().append(tempEr);
						$(xml).find('newCapt').each(function(){
							$('#capImg').empty().append('<img src="'+$(this).text()+'" >');
						});		
						$(xml).find('ans').each(function(){
							$('#castField').css('text-align', 'center').empty().append('<span style="color: red; font-size:20px; font-weight: bold;">'+$(this).text()+'</span>');
						});
						$(xml).find('captcha').each(function(){
							$('#errorAns').append('<span style="color:#F00; font-weight:bold;">'+$(this).text()+'</span><br>');
							$('#captcha2').val('');
						});
					},
					"xml"
		    );
		}
		
		function showPhotos(page)
		{
			$.get(
				"helpers/photos.php",
				"page="+page,
				function(data)
				{
					$('#help').empty().append(data);
					$("a[rel=example2]").fancybox({});
				},
				"html"
		   	);
		}
		
		function addReview()
		{
			var reviewName = $('#revN').val();
			var reviewMail = $('#revE').val();
			var comtext = $('#f1').val();
			var captcha = $('#revCap').val();
			$.post(
					"helpers/addReview.php",
					"reviewName="+reviewName+"&reviewMail="+reviewMail+"&comtext="+comtext+"&captcha="+captcha,
					function(xml)
					{
						reviewName = 0;
						reviewMail = 0;
						captcha = 0;
						$(xml).find('error').each(function(){
							switch($(this).find('key').text())
							{
								case "reviewName": reviewName = 1; $('#reviewName').empty().append($(this).find('value').text()); break;
								case "reviewMail": reviewMail = 1; $('#reviewMail').empty().append($(this).find('value').text()); break;
								case "captcha":  $('#revCap').val(''); captcha = 1; $('#captcha').empty().append($(this).find('value').text()); break;
								case "newCapt": $('#newCapt').empty().append('<img src="'+$(this).find('value').text()+'">'); break;
								case "ans": $('#revHelp').empty().append('<div style="color:#F00; font-size:20px; font-weight:bold; text-align:center;">'+$(this).find('value').text()+'</div>'); break;
							}
						});
							if (reviewName == 0)
								$('#reviewName').empty();
							if (reviewMail == 0)
								$('#reviewMail').empty();
							if (captcha == 0)
								$('#captcha').empty();
					},
					"xml"
		    );
		}
		
		function login()
		{
			var login = $('#login').val();
			var password = $('#password').val();
			var remember = $('#remember').is(':checked');
			$.post(
					"helpers/authorization.php",
					"login="+login+"&password="+password+"&remember="+remember,
					function(xml)
					{
						var login1 = 0;
						var password1 = 0;
						var pair = 0;
						$(xml).find('error').each(function(){
							switch($(this).find('key').text())
							{
								case "login1": login1 = 1; $('#login1').empty().append($(this).find('value').text()); break;
								case "password1": password1 = 1; $('#password1').empty().append($(this).find('value').text()); break;
								case "pair": pair = 1; $('#pair').empty().append($(this).find('value').text()); break;
								case "ans": window.location = "index.php"; break;
							}
						});
						
						if (login1 == 0)
								$('#login1').empty();
							if (password1 == 0)
								$('#password1').empty();
							if (pair == 0)
								$('#pair').empty();
					},
					"xml"
		    );
		}