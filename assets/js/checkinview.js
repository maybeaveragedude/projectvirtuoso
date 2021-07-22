function isInViewport(thiselement) {
    const rect = thiselement.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)

    );
}


const box = document.querySelector('.box');
const message = document.querySelector('#message');

document.addEventListener('scroll', function () {
    const messageText = isInViewport(box) ?
        'The box is visible in the viewport' :
        'The box is not visible in the viewport';

    message.textContent = messageText;

}, {
    passive: true
});
