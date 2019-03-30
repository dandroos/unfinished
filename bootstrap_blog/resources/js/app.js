
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');



window.onload = ()=>{
    const articleTitle = document.querySelector('#article-title');
    const articleSlug = document.querySelector('#article-slug');

    articleTitle.addEventListener('keyup', (e)=>{
        const update = e.target.value;
        articleSlug.textContent = 'Slug: ' + update.replace(/ /g, '-').toLowerCase();
    })

    // Dropzone.autoDiscover = false;

    
}