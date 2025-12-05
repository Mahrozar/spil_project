import './bootstrap';
// dashboard chart import (Chart.js loaded via CDN in blade)
document.addEventListener('DOMContentLoaded', function(){
	const btn = document.getElementById('sidebarToggle');
	if (btn) {
		btn.addEventListener('click', function(){
			document.querySelector('.sidebar').classList.toggle('-translate-x-full');
		});
	}
});
