// JavaScript Document
function onLoad (delay, loop)
{
	var wall = document.getElementsByClassName('wall')[0];
	setTimeout(slideOne, delay);
	function slideOne() {
		wall.style.backgroundImage = "url('img/wall_2.png')";
	}
	setTimeout(slideTwo, delay + loop);	
	function slideTwo() {
		wall.style.backgroundImage = "url('img/wall_1.png')";
	}
}

function togglePassword (self)
{
	var value = (self.type == 'password')? 'text':'password';
	self.setAttribute('type',value);
}

function onHide (args)
{
	document.getElementById(args).style.display = 'none';
}

function onDelete (id)
{
	if (confirm('Delete Record?') == true)
	{
		var request = '?enquiry_id='+id;
		location.assign(request);
	}
}