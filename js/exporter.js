function exporter() {
    var xmlContent = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    var courses = document.getElementsByClassName('s-act-tab');
    var webCourses = document.getElementsByClassName('webClass');
    xmlContent += "<courses>";
    for (var x = 0; x < courses.length; x++) {
        xmlContent += "<course>";
        var name = courses[x].getElementsByClassName('s-act-name')[0].innerHTML;
        xmlContent += "<name>" + name + "</name>";
        var teacher = courses[x].getElementsByClassName('s-act-teacher')[0].innerHTML;
        xmlContent += "<teacher>" + teacher + "</teacher>";
        var room = courses[x].getElementsByClassName('s-act-room')[0].innerHTML;
        xmlContent += "<room>" + room + "</room>";
        var times = courses[x].getElementsByClassName('s-act-times')[0].innerHTML;
        xmlContent += "<times>" + times + "</times>";
        var hours = courses[x].dataset.hours;
        xmlContent += "<hours>" + hours + "</hours>";
        var day = courses[x].dataset.day;
        xmlContent += "<day>" + day + "</day>";
        var sched = courses[x].dataset.schednum;
        xmlContent += "<schedule>" + sched + "</schedule>";
        var color = courses[x].dataset.color;
        xmlContent += "<color>" + color + "</color>";
        xmlContent += "</course>";
    }
    for (var x = 0; x < webCourses.length; x++) {
        xmlContent += "<course>";
        var name = webCourses[x].dataset.lesson;
        xmlContent += "<name>" + name + "</name>";
        var teacher = webCourses[x].dataset.teacher;
        xmlContent += "<teacher>" + teacher + "</teacher>";
        var room = webCourses[x].dataset.classroom;
        xmlContent += "<room>" + room + "</room>";
        var times = webCourses[x].dataset.times;
        xmlContent += "<times>" + times + "</times>";
        var hours = webCourses[x].dataset.hours;
        xmlContent += "<hours>" + hours + "</hours>";
        var day = webCourses[x].dataset.week;
        xmlContent += "<day>" + day + "</day>";
        var sched = webCourses[x].dataset.schednum;
        xmlContent += "<schedule>" + sched + "</schedule>";
        var color = webCourses[x].dataset.color;
        xmlContent += "<color>" + color + "</color>";
        xmlContent += "</course>";
    }
    xmlContent += "</courses>";
    var blob = new Blob([xmlContent], {type: "text/plain;charset=utf-8"});
    saveAs(blob, "calendar.xml");
}
