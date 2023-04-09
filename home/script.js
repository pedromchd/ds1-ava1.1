const form = document.forms[0].cover;
const thumb = document.querySelector('#thumbnail');

form.addEventListener('change', handleFile);

function handleFile() {
  const file = this.files[0];
  const reader = new FileReader();
  reader.onload = (evt) => {
    thumb.style.background = `#fff url(${evt.target.result}) no-repeat center / contain`;
  }
  reader.readAsDataURL(file);
}