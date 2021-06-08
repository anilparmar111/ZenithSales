<input type='button' value='Remove' onclick='removeRow(this)'/>
function removeRow(oButton) {
        var empTab = document.getElementById('tab_logic');
        empTab.deleteRow(oButton.parentNode.parentNode.rowIndex);
}