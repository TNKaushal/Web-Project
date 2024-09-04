const logregBox =  document.querySelector('.hlogreg-box');
const loginLink =  document.querySelector('.rlogin-link');
const registerLink =  document.querySelector('.register-link');

registerLink.addEventListener('click',() => {
    logregBox.classList.add('active');
});

loginLink.addEventListener('click',() => {
    logregBox.classList.remove('active');
});


