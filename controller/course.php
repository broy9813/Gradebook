<?php

// include class.rating model file
require_once __DIR__ . '\..\model\class.course.php';

// specify the content type of the data that will be
// transmitted back and forth between this file,
// the class.rating model file, and the create movie
// web page
header('Content-type: text/html');

function select_gradebook_results($name, $prof_id) {
    // create an Assessment object
    $gradebook = new Gradebook();

    // create String that will be echoed 
    // by function
    $html = '';

    // create int counter variable
    $i = 1;

    // call select movie rating method on object
    $retval = $gradebook->select_gradebook_results($name, $prof_id);
    // return value will be false if select fails   
    if (!$retval) {
        // format error message in an
        // html paragraph element
        echo '<p class="help-block">Could not execute select statement : ' . $gradebook->get_mysqli()->errno . '</p>';
    } else {
        if ($retval->num_rows != 0) {
            // format the data contained in retval in
            // html table row elements
            while ($row = $retval->fetch_array(MYSQLI_ASSOC)) {
                $html .= '<tr><th scope="row">' . $i . '</th>';
                $html .= '<td>';
                $html .= $row['id'];
                $html .= '</td>';
                $html .= '<td>';
                $html .= $row['name'];
                $html .= '</td>';
                $html .= '<td>';
                $html .= $row['prof_fname'];
                $html .= '</td>';
                $html .= '</tr>';
                $i++;
            }
        } else {
            $html .= '<tr><th scope="row">' . $i . '</th>';
                $html .= '<td>';
                $html .= 'No courses found!';
                $html .= '</td>';
                $html .= '<td>';
                $html .= '</td>';
                $html .= '<td>';
                $html .= '</td>';
                $html .= '</tr>';
        }
        echo $html;
    }
}

?>