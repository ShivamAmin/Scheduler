var xmlData;
var openFile = function (event) {
    var input = event.target;
    var reader = new FileReader();
    reader.onload = function () {
        xmlData = ParseXML(reader.result);
        loadData(xmlData);
    };
    reader.readAsText(input.files[0]);
};

function ParseXML(data) {
    if (window.DOMParser) {
        parser = new DOMParser();
        xmlDoc = parser.parseFromString(data, "text/xml");
    } else {
        xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
        xmlDoc.loadXML(data);
    }
    return xmlDoc;
}

function loadData(xmlObj) {
    var courses = xmlObj.firstChild.childNodes;

    for (var x = 0; x < courses.length; x++) {
        var name = courses[x].childNodes[0].firstChild.nodeValue;
        var teachers = courses[x].childNodes[1].firstChild.nodeValue;
        var rooms = courses[x].childNodes[2].firstChild.nodeValue;
        var times = courses[x].childNodes[3].firstChild.nodeValue;
        var hours = courses[x].childNodes[4].firstChild.nodeValue;
        var day = courses[x].childNodes[5].firstChild.nodeValue;
        var schedNum = courses[x].childNodes[6].firstChild.nodeValue;
        var color = courses[x].childNodes[7].firstChild.nodeValue;
        schedule.activities.add(schedNum, day, name, hours, rooms, times, teachers, color);
    }
}
