/**
 * Google Analytics Events 
 */
 
var footerEnquiryButton = document.querySelector('.enquiry .enquiry__cta a.button-small');
var contactPageIframe = document.querySelector('.page-node-38 .main iframe');

if (footerEnquiryButton) addListener(footerEnquiryButton, 'click', function() {
  ga('send', 'event', 'Enquiry', 'Course Enquiry', 'Footer Enquiry Button', 1);
});

if (contactPageIframe) addListener(contactPageIframe, 'click', function() {
  console.log('enquiring!')
  ga('send', 'event', 'Enquiry', 'Course Enquiry', 'Contact Page Enquiry Form', 1);
});


/**
 * Utility to wrap the different behaviors between W3C-compliant browsers
 * and IE when adding event handlers.
 *
 * @param {Object} element Object on which to attach the event listener.
 * @param {string} type A string representing the event type to listen for
 *     (e.g. load, click, etc.).
 * @param {function()} callback The function that receives the notification.
 */
function addListener(element, type, callback) {
 if (element.addEventListener) element.addEventListener(type, callback);
 else if (element.attachEvent) element.attachEvent('on' + type, callback);
}