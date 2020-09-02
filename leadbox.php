<style>
@keyframes md-bouncein {
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

@-webkit-keyframes md-fadein {
	0% {
		opacity: 0;
	}
	100% {
		opacity: 1;
	}
}

@keyframes md-fadein {
	0% {
		opacity: 0;
	}
	100% {
		opacity: 1;
	}
}

@-webkit-keyframes md-fadeout {
	0% {
		opacity: 1;
	}
	100% {
		opacity: 0;
	}
}

@keyframes md-fadeout {
	0% {
		opacity: 1;
	}
	100% {
		opacity: 0;
	}
}

@-webkit-keyframes md-rotation {
	0% {
		-webkit-transform: rotate(0deg);
		transform: rotate(0deg);
	}
	100% {
		-webkit-transform: rotate(359deg);
		transform: rotate(359deg);
	}
}

@keyframes md-rotation {
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
.modal-triggered .md-modal-wrap {
	display: flex;
}
.md-modal-wrap {
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

.md-modal-overlay {
	-webkit-animation: md-fadein .5s;
	animation: md-fadein .5s;

	background-color: rgba(240, 93, 41, 0.5);

	position: absolute;
	top: 0;
	left: 0;

	width: 100%;
	height: 100%;

	z-index: 1000;
}

.md-modal {
	-webkit-overflow-scrolling: touch;

	-webkit-animation: md-bouncein 1s;
	animation: md-bouncein 1s;

	color: #000;
	font-size: 16px;
	line-height: 1;
	padding: 20px;
	width: 100%;
	z-index: 1001;
}

.md-modal-content {
	background: #fff;
	margin: 0 auto;
	max-width: 100%;
	padding: 20px;
	position: relative;
	text-align: center;
	width: 570px;
}

.md-modal-content h2 {
	font-family: 'PT Sans Narrow', sans-serif;
	font-size: 32px;
	font-weight: 400;
	margin: 0 0 20px;
	text-transform: uppercase;
}

.md-modal-content p {
	font-family: 'PT Sans Narrow', sans-serif;
	font-size: 16px;
	font-weight: 500;
	line-height: 1.4;
	margin: 0 0 20px
}

.md-modal-content p:last-child,
.md-modal-content .md-modal-share p:nth-last-child(3) {
	margin: 0;
}

.md-modal-content a {
	color: #14528d;
	text-decoration: underline;
}

.md-modal-close {
	cursor: pointer;
	font-family: 'PT Sans Narrow', sans-serif;
	font-size: 30px;
	font-weight: 400;
	position: absolute;
	right: 12px;
	top: 0;
}

.md-modal-content .accept {
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

.md-modal-content .accept:active {
	position: relative;
	top: 1px;
}

.md-modal-content .md-modal-share {
	display: none;
}

.md-modal.accepted .md-modal-cookie {
	display: none;
}

.md-modal.accepted .md-modal-share {
	-webkit-animation: md-fadein 2s;
	animation: md-fadein 2s;
	display: block;
}

.md-modal-content .md-modal-buttons {
	margin-bottom: 10px;
}

.md-modal-content .md-modal-buttons a {
	border-radius: 3px;
	color: #fff;
	display: inline-block;
	font-family: 'PT Sans Narrow', sans-serif;
	font-weight: 400;
	margin: 5px;
	padding: 15px 30px;
	text-decoration: none;
	text-transform: uppercase;
}

.md-modal-content .facebook {
	background-color: #3b5998;
}

.md-modal-content .instagram {
	background-color: #f1007c;
}

.md-modal-content .newsletter {
	background-color: #80bb40;
}

@media only screen and (min-width: 1025px) {
	.md-modal-content {
		padding: 30px;
	}
	.md-modal-content .accept {
		margin: 30px 0 50px;
	}
	.md-modal-content .md-modal-buttons {
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
var cookieStatus = readCookie('md_com_cookies');

// Show modal after 5 seconds unless cookies have been accepted
if (cookieStatus !== 'accepted') {
	window.onload = function() {
		setTimeout(showModal, 5000)
	};
}

// Show the modal by adding a class to the body of the document
function showModal() {
	body = document.body;
	modal = document.getElementById('md-modal');

	// Show the modal
	body.classList.add('modal-triggered');

	// Google Analytics Event
	/*
	gtag('event', 'cookies_notice_displayed', {
		'send_to': 'UA-44082856-1',
		'event_category': 'cookies',
		'event_label': ''
	});
	*/

	// Hide the modal by removing the 'modal-triggered' class from the body
	function hideModal() {
		body.classList.remove('modal-triggered');

		// Google Analytics Event
		/*
		gtag('event', 'cookies_notice_dismissed', {
			'send_to': 'UA-44082856-1',
			'event_category': 'cookies',
			'event_label': ''
		});
		*/
	}
	var closeButton = document.getElementById('md-modal-close');
	closeButton.onclick = hideModal;

	// Hide the modal when pressing the 'escape' key
	document.addEventListener('keydown', function(e) {
		if (e.keyCode == 27) {
			body.classList.remove('modal-triggered');
		}
	});

	// Hide the modal when clicking outside the modal area
	modal.addEventListener('click', function (e) {
		if (e.target === e.currentTarget) {
			hideModal();
		}
	});

	// Set a cookie when clicking the 'accept' button and show the share modal
	function acceptCookies() {

		// Set expiry date to today + 1 year
		var cookieExpirationDate = new Date;
		cookieExpirationDate.setFullYear(cookieExpirationDate.getFullYear() +1);

		function writeCookie() {
			document.cookie='md_com_cookies=accepted; expires=' + cookieExpirationDate.toGMTString() + '; domain=.materialdistrict.com; path=/;';
		}
		writeCookie();

		modal.classList.add('accepted');

		// Google Analytics Event
		/*
		gtag('event', 'cookies_accepted', {
			'send_to': 'UA-44082856-1',
			'event_category': 'cookies',
			'event_label': ''
		});
		*/

	}
	var acceptButton = document.getElementById('accept');
	acceptButton.onclick = acceptCookies;

}
</script>
<div class="md-modal-wrap">
	<div class="md-modal-overlay"></div>
	<div class="md-modal" id="md-modal">
		<div class="md-modal-content">
			<div class="md-modal-cookie">
				<h2>Request a catalogue</h2>

			</div>
			<div class="md-modal-share">
					<span class="md-modal-close" id="md-modal-close">&times;</span>
					<h2>Never miss a great story</h2>
					<p>Make sure you'll never miss a good material story again. We are happy to keep you posted the way you like!</p>
					<p><small>Follow us on:</small></p>
					<div class="md-modal-buttons">
						<a href="https://www.facebook.com/materialdistrict/" target="_blank" class="facebook">Facebook</a>
						<a href="https://www.instagram.com/materialdistrict/" target="_blank" class="instagram">Instagram</a>
						<a href="https://materialdistrict.com/register/" class="newsletter">Newsletter</a>
					</div>
					<p><small>Follow us also on <a href="https://www.linkedin.com/company/materialdistrict" target="_blank">Linkedin</a>, <a href="https://twitter.com/materialdistrct" target="_blank">Twitter</a>, <a href="https://www.pinterest.com/materialdistrict/" target="_blank">Pinterest</a> and <a href="https://www.youtube.com/channel/UCR0-ih7DLs96uCXFoEKkQmA" target="_blank">Youtube</a>.</small></p>
				</div>
		</div>
	</div>
</div>