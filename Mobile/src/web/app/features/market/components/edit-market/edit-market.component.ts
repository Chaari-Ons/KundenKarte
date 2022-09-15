import {Component, Input, OnInit} from '@angular/core';
import {FormBuilder, FormGroup, Validators} from '@angular/forms';
import {Router} from '@angular/router';
import {NzMessageService} from 'ng-zorro-antd/message';
import {MarketService} from '../../services/market.service';
import {MarketComponent} from '../../market.component';
import {environment} from 'src/environments/environment';


@Component({
  selector: 'app-edit-market',
  templateUrl: './edit-market.component.html',
  styleUrls: ['./edit-market.component.scss'],
})
export class EditMarketComponent implements OnInit {
  @Input() marketObject: any;

  validateForm!: FormGroup;
  uploadedFile: File;

  constructor( private marketService: MarketService,
               private marketComponent: MarketComponent,
               private router: Router,
               private fb: FormBuilder,
               private msg: NzMessageService) {
  }

  ngOnInit() {
    this.marketObject.logoname = this.marketObject.logo.substr(this.marketObject.logo.lastIndexOf('/') + 1);
    this.validateForm = this.fb.group({
      name: [null, [Validators.required]],
    });
  }

  handleChange(e) {
    this.uploadedFile = e.target.files[0];
    this.marketObject.logoname = this.uploadedFile.name;
  }

  private updateMarket() {
    const formData = new FormData();
    if (this.validateForm.valid) {
      formData.append('name', this.validateForm.value.name);
      if (this.uploadedFile){
        formData.append('logo', this.uploadedFile, this.uploadedFile.name);
      }
      this.marketService.updateMarket(formData,this.marketObject.id)
        .subscribe(response => {
          this.marketComponent.handleCancelEditModal(this.marketObject);
        }, err => {
          console.log(err);
        });
    } else {
      Object.values(this.validateForm.controls).forEach(control => {
        if (control.invalid) {
          control.markAsDirty();
          control.updateValueAndValidity({ onlySelf: true });
        }
      });
    }
  }

}
