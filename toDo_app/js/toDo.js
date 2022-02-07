var count = 1;
document.addEventListener('submit', function(e) { checkText(e) }, false);
document.addEventListener('dblclick', function(e) { deleteNote(e) }, false);
document.addEventListener('click', function(e) { markNote(e) }, false);

function checkText(e) {
	var target = e.target;
	if(target.className.indexOf('btn') > -1) {
		var text = document.getElementById('textForNote').value;
		if(text.length > 0) {
			var notes = document.getElementById('notes');
			var newNote = document.createElement('li');
			newNote.setAttribute('id', 'note' + count++);
			newNote.setAttribute('class', 'note');
			newNote.innerHTML = text;
			notes.appendChild(newNote);
			document.getElementById('textForNote').value = '';
		}
	}
}

function deleteNote(e) {
	e.preventDefault();
	var target = e.target;
	if(target.className.indexOf('note') > -1) {
		target.remove();
	}
}

function markNote(e) {
	e.preventDefault();
	var target = e.target;
	if(target.className.indexOf('note') > -1) {
		target.style.backgroundImage = "url(images/completed.png), url(images/progress.png)";
		target.style.backgroundRepeat = "no-repeat no-repeat";
	}
	else {
		checkText(e);
	}
}

/*
var startItem = document.getElementById('two');
var prevItem = previousElement(startItem);
var nextItem = nextElement(startItem);
console.log(nextItem);
console.log(prevItem);
prevItem.className = 'complete';
nextItem.className = 'cool';

function nextElement(element) {
	var next = element.nextSibling;
	if(next.nodeName === '#text')
		return nextElement(next);
	return next;
};

function previousElement(element) {
	var previous = element.previousSibling;
	if(previous.nodeName === '#text')
		return previousElement(previous);
	return previous;
};
*/