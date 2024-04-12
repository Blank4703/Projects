document.addEventListener('DOMContentLoaded', function() {
    let view = document.getElementById('b1');
    let add = document.getElementById('b2');
    let edit = document.getElementById('b3');
    view.addEventListener("click", function(){
        let vi = document.getElementById('view');
        let ad = document.getElementById('add');
        let ed = document.getElementById('edit');
        let p = document.getElementById('para');
        vi.style.display = 'block';
        ad.style.display = 'none';
        ed.style.display = 'none';
        p.style.display = 'none'
    });
    add.addEventListener("click", function(){
        let vi = document.getElementById('view');
        let ad = document.getElementById('add');
        let ed = document.getElementById('edit');
        let p = document.getElementById('para');
        vi.style.display = 'none';
        ad.style.display = 'block';
        ed.style.display = 'none';
        p.style.display = 'none'
    });
    edit.addEventListener("click", function(){
        let vi = document.getElementById('view');
        let ad = document.getElementById('add');
        let ed = document.getElementById('edit');
        let p = document.getElementById('para');
        vi.style.display = 'none';
        ad.style.display = 'none';
        ed.style.display = 'block';
        p.style.display = 'none'
    });

    let addsub = document.getElementById('addsub');
    addsub.addEventListener("click", function(){
        checkStart();
        checkEnd();
    });
	let editsub = document.getElementById('editsub');
    editsub.addEventListener("click", function(){
        editCheckEnd();
    });

	let editButtons = document.querySelectorAll('.edit-button');
	editButtons.forEach(function(editButton) {
  		editButton.addEventListener('click', function() {
    	let projectCard = editButton.closest('.x');
    	let hiddenForm = projectCard.nextElementSibling;
    	projectCard.style.display = 'none';
    	hiddenForm.style.display = 'block';
 	 	});
	});

	let backButton = document.querySelectorAll('.back');
	backButton.forEach(function(backButton) {
  		backButton.addEventListener('click', function() {
    		let hiddenForm = backButton.closest('.y');
    		let projectCard = hiddenForm.previousElementSibling;
   			projectCard.style.display = 'block';
    		hiddenForm.style.display = 'none';
  		});
	});
	const deleteButtons = document.querySelectorAll('.delete');
    const delHiddens = document.querySelectorAll('.del-hidden');
    const delBacks = document.querySelectorAll('.del-back');

    deleteButtons.forEach((deleteButton, index) => {
        const delHidden = delHiddens[index];
        const delBack = delBacks[index];

        deleteButton.addEventListener('click', () => {
            delHidden.style.display = 'block';
        });

        delBack.addEventListener('click', () => {
            delHidden.style.display = 'none';
        });
    });

});

function checkStart() {
  let date = document.getElementById("start");
  let newDate = new Date(date.value);
  let today = new Date();

  today.setHours(0, 0, 0, 0);

  newDate.setHours(0, 0, 0, 0);

  let timeDiff = newDate.getTime() - today.getTime();

  if (timeDiff >= 86400000) { 
    date.setCustomValidity("");
    return true;
  } else {
    date.setCustomValidity("Start date has to be at least one day in the future!");
    return false;
  }
}

function checkEnd() {
  let start = document.getElementById("start");
  let end = document.getElementById("end");
  let startDate = new Date(start.value);
  let endDate = new Date(end.value);

  startDate.setHours(0, 0, 0, 0);

  endDate.setHours(0, 0, 0, 0);

  let timeDiff = endDate.getTime() - startDate.getTime();

  if (timeDiff >= 86400000) { 
    end.setCustomValidity("");
    return true;
  } else {
    end.setCustomValidity("End date has to be at least one day after start date!");
    return false;
  }
}

function editCheckEnd() {
  let start = document.getElementById("ed-start");
  let end = document.getElementById("ed-end");
  let startDate = new Date(start.value);
  let endDate = new Date(end.value);

  startDate.setHours(0, 0, 0, 0);

  endDate.setHours(0, 0, 0, 0);

  let timeDiff = endDate.getTime() - startDate.getTime();

  if (timeDiff >= 86400000) { 
    end.setCustomValidity("");
    return true;
  } else {
    end.setCustomValidity("End date has to be at least one day after start date!");
    return false;
  }
}