/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(function() {
    $('[data-toggle="popover"]').popover();
});

import TableCellSelector from "js-table-cell-selector";


let table = document.getElementById("container-table");
let options = {deselectOutTableClick: false, enableChanging: true};
let buffer = new TableCellSelector.Buffer();
let tcs = new TableCellSelector(table, options, buffer);
tcs.enableHotkeys = true;

import AWN from "awesome-notifications";

let notifier = new AWN();

import {Tooltip} from 'bootstrap'

let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new Tooltip(tooltipTriggerEl)
})

$('#plant-seed').on('click', function () {
    if ($('.tcs-select.tcs-ignore').length) {
        notifier.warning('That spot is taken');
    } else {
        let coords = tcs.getCoords();
        let seedId = $('#seed_list [value="' + $('#seed_selection').val() + '"]').data('value');
        let containerId = $(tcs.obTable.table).data('id')
        let data = {};
        $.each($('#plantModal').find('form').serializeArray(), function () {
            data[this.name] = this.value;
        });
        axios.post('/plant', {
            ...data,
            seedId: seedId,
            containerId: containerId,
            coords: coords
        }).then(function (response) {
            location.reload();
        });
    }
})

$('#delete-seed').on('click', function () {
    let plantIds = $('.tcs-select').map(function () {
        return $(this).data('id');
    }).get();

    let returnSeedsToStock = confirm('Return seeds to stock ?');

    axios.post('/delete', {
        plantIds: plantIds,
        returnSeedsToStock: returnSeedsToStock,
    }).then(function (response) {
        location.reload();
    });
});

import {Modal} from 'bootstrap';

let $plant = $('.plant');
$plant.on('dblclick', function () {
    let plantId = $(this).data('id');
    let $observationModal = $('#observationModal');
    let modal = new Modal($observationModal);
    modal.show();

    $observationModal.find('#plant-id').val(plantId);
});

$plant.on('contextmenu', function (e) {
    e.preventDefault();

    let plantId = $(this).data('id');

    axios.get('/observations/' + plantId).then(function (response) {
        if(response.data.length) {
            let trHTML = '';
            $.each(response.data, function (i, item) {
                trHTML += '<tr><td class="bg-' + item.severity + '">&nbsp;</td><td>' + item.observedAt + '</td><td>' + item.note + '</td></tr>';
            });
            $('#observationTable tbody').empty().append(trHTML);

            let $observationListModal = $('#observationListModal');
            let modal = new Modal($observationListModal);
            modal.show();
        }
    });


    return false;
});

$('#observe').on('click', function () {
    let data = {};
    $.each($('#observationModal').find('form').serializeArray(), function () {
        data[this.name] = this.value;
    });

    axios.post('/observe', data);
});

$('select#severity').on('change', function () {
    let $el = $(this);
    $el.removeClass(function (index, css) {
        return (css.match(/(^|\s)bg-\S+/g) || []).join(' ');
    }).addClass($el.find('option:selected').attr('class'));
})

