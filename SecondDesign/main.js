const typeWriter = function(txtElement, words, wait = 3000)
{
    this.txtElement = txtElement;
    this.words = words;
    this.txt= '';
    this.wordIndex = 0;
    this.wait = parseInt(wait, 10);
    this.type();
    this.isDeleting = false;
}

//type method
typeWriter.prototype.type = function()
{
    //current index of word
    const current = this.wordIndex % this.words.length;
    //get text of current word
    const fullTxt = this.words[current];
    //check if deleting
    if(this.isDeleting)
    {
        //remove
        this.txt = fullTxt.substring(0,this.txt.length - 1);
    }
    else
    {
        //add
        this.txt = fullTxt.substring(0,this.txt.length + 1);
    }

    //output
    this.txtElement.innerHTML = `<span class="txt">${this.txt}</span>`;

    //init type speed
    let typeSpeed = 300;
    if(this.isDeleting)
    {
        typeSpeed /= 2;
    }

    //check if word is complete
    if(!this.isDeleting && this.txt === fullTxt)
    {
        typeSpeed = this.wait; //pause at word end
        this.isDeleting = true;

    }
    else if(this.isDeleting && this.txt === '')
    {
        this.isDeleting = false;
        this.wordIndex++; //changes word
        typeSpeed = 500; //pause before typing again
    }

    setTimeout(() => this.type(), typeSpeed);
}

//runs when DOM loads
document.addEventListener('DOMContentLoaded',init());

//grabs everything from the html
function init()
{
    const txtElement = document.querySelector('.textType');
    const words = JSON.parse(txtElement.getAttribute('data-words'));
    const wait = txtElement.getAttribute('data-wait');

    new typeWriter(txtElement, words, wait);
}