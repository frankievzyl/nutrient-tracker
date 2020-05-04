function display_signup() {
    var popup = document.getElementsByClassName("popup-layer-1").item(0);
    var cover = document.getElementsByClassName("cover").item(0);
    popup.style.display = "flex";
    cover.style.display = "block";
}

function hide_signup() {
    var popup = document.getElementsByClassName("popup-layer-1").item(0);
    var cover = document.getElementsByClassName("cover").item(0);
    popup.style.display = "none";
    cover.style.display = "none";
}

function set_page_title(new_title) {
    document.title = new_title;
}

function hide_show_column(column_class) {
    var cells = document.querySelector(column_class);

    for (let i = 0; i < cells.length; i++) {
        
        var state = cells[i].dataset.visState;
        state = state == "vis" ? "invis" : "vis";
    }
}

function show_tab(type_class) {
    var rows = document.querySelector(type_class);

    for (let i = 0; i < rows.length; i++) {
        
        var state = rows[i].dataset.tabState;
        state = state == "vis" ? "invis" : "vis";
    }
}