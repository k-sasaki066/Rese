document.querySelector('#drawer-toggle').addEventListener('click', function(){
    this.classList.toggle('open');
    document.querySelector('#header-nav').classList.toggle('sp_open');
})