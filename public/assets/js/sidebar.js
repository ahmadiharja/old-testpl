document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("btn-sidebar-toggle").addEventListener("click", function(){ 
		document.body.getAttribute("data-sidebar-size") === "wide" ? document.body.setAttribute("data-sidebar-size", "narrow") : document.body.setAttribute("data-sidebar-size", "wide");
	});
});

