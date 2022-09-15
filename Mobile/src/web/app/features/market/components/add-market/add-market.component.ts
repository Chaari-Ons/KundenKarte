import {Component, OnInit} from '@angular/core';
import {FormBuilder, FormGroup, Validators} from '@angular/forms';
import {Router} from '@angular/router';
import {NzMessageService} from 'ng-zorro-antd/message';
import {NzUploadChangeParam} from 'ng-zorro-antd/upload';
import {MarketService} from '../../services/market.service';
import {MarketComponent} from '../../market.component';

@Component({
  selector: 'app-add-market',
  templateUrl: './add-market.component.html',
  styleUrls: ['./add-market.component.scss'],
})
export class AddMarketComponent implements OnInit {

  validateForm!: FormGroup;
  uploadedFile: File;

  constructor(private marketService: MarketService,
              private marketComponent: MarketComponent,
              private router: Router,
              private fb: FormBuilder,
              private msg: NzMessageService) {
  }

  ngOnInit() {
    this.validateForm = this.fb.group({
      name: [null, [Validators.required]],
    });
  }

  handleChange(e){
    this.uploadedFile = e.target.files[0];
  }

  onSaveMarket() {
    const formData = new FormData();
    if (this.validateForm.valid) {
      formData.append('name',this.validateForm.value.name);
      formData.append('logo', this.uploadedFile, this.uploadedFile.name);
      this.marketService.createMarket(formData)
        .subscribe(res => {
          this.marketComponent.handleCancelAddModal();
          this.marketComponent.getMarkets();
          }, err => {
            console.log(err);
          }
        );
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
