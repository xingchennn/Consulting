import { Component, Input, Output, EventEmitter } from '@angular/core';


@Component({
  selector: 'app-list',
  templateUrl: './list.component.html',
  styleUrls: ['./list.component.css']
})
export class ListComponent {

  @Input() aptList: any;

  @Output() deleteEvent = new EventEmitter();

  handleDelete(theApt: object) {
    // console.log(theApt);
    this.deleteEvent.emit(theApt);
  }

  getColor(theApt: object) {
    return theApt['booked'] === 1 ? 'green' : 'slategray' ;
  }

  getBookedStatus(theApt: object) {
    if (theApt['booked'] === 1) {
      return true;
    } else {
      return false;
    };
  }


}
