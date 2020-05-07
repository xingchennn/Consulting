import { Component, OnInit, Output, EventEmitter } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';

import { Appoint } from '../appoint';


@Component({
  selector: 'app-add',
  templateUrl: './add.component.html',
  styleUrls: ['./add.component.css']
})
export class AddComponent implements OnInit {


  responsedata = new Appoint('', '', '', '','null', 'null');

  showForm: boolean;

  appointment = new Appoint('', '', '', '','null','null');

  @Output() addEvent = new EventEmitter();

  toggleAptDisplay() {
    this.showForm = !this.showForm;
  }

  handleAdd(formInfo: any) {
    const tempItem: object = {
      date: formInfo.date,
      startTime: formInfo.startTime,
      endTime: formInfo.endTime,
      aptNote: formInfo.aptNote,
    };
    this.addEvent.emit(tempItem);
    this.showForm = ! this.showForm;

    this.appointment.date = formInfo.date;
    this.appointment.startTime = formInfo.startTime;
    this.appointment.endTime = formInfo.endTime;
    this.appointment.aptNote = formInfo.aptNote;
    this.appointment.booked = 'null';
    this.appointment.bookedBy = 'null';

    const params = JSON.stringify(this.appointment);
    // post data to databse
    this.http.post<Appoint>('http://localhost/xl4hk-my5an-assign4/ngphp-post.php', params)
     .subscribe((data) => {
          console.log("succeed to post data");

          // console.log('Response from backend ', data);
          this.responsedata = data;     // assign response to responsedata property to bind to screen later
     }, (error) => {
       console.log('Error test error test error test eroroooooooooooooooooooooooooooooooooooooo', error);
     });

  }

  constructor(private http: HttpClient) {
    this.showForm = true;
  }
  ngOnInit(): void {
  }

}
