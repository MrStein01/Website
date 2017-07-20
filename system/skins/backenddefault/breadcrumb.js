var closeTimer	= null;
var folder	    = null;

function openFolders(){	
  cancelClosingFolders();
  if(folder){
    folder.style.visibility = 'hidden';
  }
  folder = document.getElementById('subfolders');
  folder.style.visibility = 'visible';
}

function closeFolders(){
  if(folder) folder.style.visibility = 'hidden';
}

function closeFoldersTime(){
  closeTimer = window.setTimeout(closeFolders, 500);
}

function cancelClosingFolders(){
  if(closeTimer){
    window.clearTimeout(closeTimer);
    closeTimer = null;
  }
}

document.onclick = closeFolders; 