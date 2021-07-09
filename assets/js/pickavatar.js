
let x
let img
let prex
function reply_click(clicked_id)
  {
      //alert(clicked_id);
      x = document.getElementById(clicked_id);
      let child = x.children[0];
      let grandchild = child.children[0];
      img = grandchild.src;
      //alert(img);
  }

function apply_image(){
    document.getElementById('profileavatar').setAttribute('src',img);
    let child = x.children[0];
    let grandchild = child.children[0];
    alert('New Avatar Selected!');
}

