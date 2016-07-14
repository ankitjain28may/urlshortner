var tooltip, // global variables oh my! Refactor when deploying!
	hidetooltiptimer
createtooltip();
function createtooltip(){ // call this function ONCE at the end of page to create tool tip object
	tooltip = document.createElement('div')
	tooltip.style.cssText = 
		'position:absolute; background:black; color:white; padding:4px;z-index:10000;'
		+ 'border-radius:2px; font-size:12px;box-shadow:3px 3px 3px rgba(0,0,0,.4);'
		+ 'opacity:0;transition:opacity 0.3s'
	tooltip.innerHTML = 'Copied!'
	document.body.appendChild(tooltip)
}

function showtooltip(e){
	var evt = e || event
	clearTimeout(hidetooltiptimer)
	tooltip.style.left = evt.pageX - 10 + 'px'
	tooltip.style.top = evt.pageY + 15 + 'px'
	tooltip.style.opacity = 1
	hidetooltiptimer = setTimeout(function(){
		tooltip.style.opacity = 0
	}, 500)
}


function copyText(e)
{
    var txt=document.getElementById("short");
    txt.focus();
    txt.setSelectionRange(0,txt.value.length);  //   try {
    var successful = document.execCommand('copy');
    if(successful)
    {
    	showtooltip(e);
    }
}