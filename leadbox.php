<style>
@keyframes marta-bouncein {
	0% {
		transform: scale(0.1);
		opacity: 0;
	}
	60% {
		transform: scale(1.2);
		opacity: 1;
	}
	100% {
		transform: scale(1);
	}
}

@-webkit-keyframes marta-fadein {
	0% {
		opacity: 0;
	}
	100% {
		opacity: 1;
	}
}

@keyframes marta-fadein {
	0% {
		opacity: 0;
	}
	100% {
		opacity: 1;
	}
}

@-webkit-keyframes marta-fadeout {
	0% {
		opacity: 1;
	}
	100% {
		opacity: 0;
	}
}

@keyframes marta-fadeout {
	0% {
		opacity: 1;
	}
	100% {
		opacity: 0;
	}
}

@-webkit-keyframes marta-rotation {
	0% {
		-webkit-transform: rotate(0deg);
		transform: rotate(0deg);
	}
	100% {
		-webkit-transform: rotate(359deg);
		transform: rotate(359deg);
	}
}

@keyframes marta-rotation {
	0% {
		-webkit-transform: rotate(0deg);
		transform: rotate(0deg);
	}
	100% {
		-webkit-transform: rotate(359deg);
		transform: rotate(359deg);
	}
}

*,
*:before,
*:after {
	box-sizing: border-box;
}
.modal-triggered .marta-modal-wrap {
	display: flex;
}
.marta-modal-wrap {
	align-items: center;
	display: none;
	justify-content: center;

	position: fixed;
	top: 0;
	left: 0;

	width: 100%;
	height: 100%;

	z-index: 1000;
}

.marta-modal-overlay {
	-webkit-animation: marta-fadein .5s;
	animation: marta-fadein .5s;

	background-color: rgba(240, 93, 41, 0.5);
	background-color: rgba(204, 204, 204, 0.7);

	position: absolute;
	top: 0;
	left: 0;

	width: 100%;
	height: 100%;

	z-index: 1000;
}

.marta-modal {
	-webkit-overflow-scrolling: touch;

	-webkit-animation: marta-bouncein 1s;
	animation: marta-bouncein 1s;

	color: #000;
	font-size: 16px;
	line-height: 1;
	padding: 20px;
	width: 100%;
	z-index: 1001;
}

.marta-modal-content {
	background: #fff;
	margin: 0 auto;
	max-width: 100%;
	padding: 20px;
	position: relative;
	text-align: center;
	width: 570px;
}

.marta-modal-content .gform_wrapper {
	margin-bottom: 0;
}

.marta-modal-content input[type=submit] {
	background-color: #f05d29;
	border-color: #f05d29;
}

.marta-modal-content .gform_wrapper .gform_footer {
	margin: 0;
}

.marta-modal-content h2 {
	font-family: 'PT Sans Narrow', sans-serif;
	font-size: 32px;
	font-weight: 400;
	margin: 30px 0 20px 0;
	text-transform: uppercase;
}

.marta-modal-content p {
	font-family: 'PT Sans Narrow', sans-serif;
	font-size: 16px;
	font-weight: 500;
	line-height: 1.4;
	margin: 0 0 20px
}

.marta-modal-content p:last-child {
	margin: 0;
}

.marta-modal-content a {
	color: #14528d;
	text-decoration: underline;
}

button.marta-modal-close {
	cursor: pointer;
	position: absolute;
	right: 0;
	top: 7px;
}

.marta-modal-content .accept {
	background-color: #f05d29;
	border-radius: 3px;
	color: #fff;
	cursor: pointer;
	display: inline-block;
	font-family: 'PT Sans Narrow', sans-serif;
	font-weight: 400;
	margin: 0 0 20px;
	padding: 15px 30px;
	text-transform: uppercase;
}

.marta-modal-content .accept:active {
	position: relative;
	top: 1px;
}

@media only screen and (min-width: 1025px) {
	.marta-modal-content {
		padding: 30px;
	}
	.marta-modal-content h2 {
		margin: 5px 0 20px 0;
	}
	.marta-modal-content .accept {
		margin: 30px 0 50px;
	}
	.marta-modal-content .marta-modal-buttons {
		margin-bottom: 40px;
	}
}
</style>

<script>
// ReadCookie function
function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0) === ' ') {
			c = c.substring(1,c.length);
		}
		if (c.indexOf(nameEQ) === 0) {
			return c.substring(nameEQ.length,c.length);
		}
	}
	return null;
}
var cookieStatus = readCookie('marta_modal');
var modalViews = readCookie('marta_modal_views');

// Show modal after 5 seconds unless cookies have been completed
if ((cookieStatus !== 'completed') && (modalViews <= 3)) {
	window.onload = function() {
		setTimeout(showModal, 5000)
	};
}

// Set a cookie when closing the modal
function setCookie(action) {

	// Set expiry date to today + 1 year if lead completed, else + 2 days
	var cookieExpirationDate = new Date;

	if (action === 'completed') {
		cookieExpirationDate.setFullYear(cookieExpirationDate.getFullYear() +1);
		cookieName = 'marta_modal';
		cookieValue = 'completed';
	} else if (action === 'viewed') {
		cookieName = 'marta_modal_views';
		modalViews++;
		cookieValue = modalViews;
		cookieExpirationDate.setDate(cookieExpirationDate.getDate() + 30);
	} else {
		cookieName = 'marta_modal';
		cookieValue = 'dismissed';
		cookieExpirationDate.setFullYear(cookieExpirationDate.getFullYear() +1);
	}

	function writeCookie() {
		document.cookie= cookieName + '=' + cookieValue + '; expires=' + cookieExpirationDate.toGMTString() + '; domain=.<?php echo $_SERVER['HTTP_HOST']; ?>; path=/;';
	}
	writeCookie();

	modal.classList.add('completed');

}

// Hide the modal by removing the 'modal-triggered' class from the body
function hideModal(action) {
	body.classList.remove('modal-triggered');
	setCookie(action);
}

// Show the modal by adding a class to the body of the document
function showModal() {
	body = document.body;
	modal = document.getElementById('marta-modal');

	setCookie('viewed');

	// Show the modal
	body.classList.add('modal-triggered');

	// Hide the modal when pressing the 'escape' key
	document.addEventListener('keydown', function(e) {
		if (e.keyCode == 27) {
			hideModal('dismissed');
		}
	});

	// Hide the modal when clicking outside the modal area
	modal.addEventListener('click', function (e) {
		if (e.target === e.currentTarget) {
			hideModal('dismissed');
		}
	});

}
</script>
<div class="marta-modal-wrap">
	<div class="marta-modal-overlay"></div>
	<div class="marta-modal" id="marta-modal">
		<div class="marta-modal-content">
			<button class="button marta-modal-close" onClick="hideModal('dismissed')">Close window</button>
			<h2>Nice to meet you!</h2>
			<?php gravity_form( 'Lead', $display_title = false, $display_description = true, $display_inactive = false, $field_values = null, $ajax = true, $tabindex, $echo = true ); ?>
		</div>
	</div>
</div>