function saveNote() {
    var note = document.getElementById("noteTextarea").value;
    // You can implement saving functionality here, like sending the note to a server or saving it locally.
    console.log("Note saved:", note);
    alert("Note saved!");   
}

function deleteNote() {
    document.getElementById("noteTextarea").value = "";
    // You can implement    deletion functionality here, like deleting the note from a server or locally.
    console.log("Note deleted");
    alert("Note deleted!");
}