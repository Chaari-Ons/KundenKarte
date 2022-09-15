import {Component, Input, OnInit} from '@angular/core';
import {FormBuilder, FormGroup, Validators} from '@angular/forms';
import {Router} from '@angular/router';
import {NzMessageService} from 'ng-zorro-antd/message';
import {MarketBranchService} from '../../services/market-branch.service';
import {CityService} from '../../services/city.service';
import {City} from '../../../../models/city.model';
import {ListMarketBranchesComponent} from '../list-market-branches/list-market-branches.component';

@Component({
  selector: 'app-add-market-branch',
  templateUrl: './add-market-branch.component.html',
  styleUrls: ['./add-market-branch.component.scss'],
})
export class AddMarketBranchComponent implements OnInit {
  @Input() marketId: number;

  validateForm!: FormGroup;
  listCities: City[] = [];

  constructor(private marketBranchService: MarketBranchService,
              private cityService: CityService,
              private listMarketBranchesComponent: ListMarketBranchesComponent,
              private router: Router,
              private fb: FormBuilder,
              private msg: NzMessageService) {
  }

  ngOnInit() {
    this.getCities();
    this.validateForm = this.fb.group({
      marketBranchName: [null, [Validators.required]],
      city: [null, [Validators.required]],
      street: [null, [Validators.required]],
      streetNumber: [null, [Validators.required]],
      zip: [null, [Validators.required]],
      longitude: [null, [Validators.required]],
      latitude: [null, [Validators.required]],
    });
  }

  getCities() {
    this.cityService.getCities()
      .subscribe(response => {
        this.listCities = response['data'];
      }, err => {
        console.log(err);
      });
  }

  onSaveMarketBranch() {
    if (this.validateForm.valid) {
      const formData = this.validateForm.value;
      this.marketBranchService.saveMarketBranch(formData, this.marketId)
        .subscribe(response => {
          this.listMarketBranchesComponent.handleCancelAddModal();
          this.listMarketBranchesComponent.getMarketsById();
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
