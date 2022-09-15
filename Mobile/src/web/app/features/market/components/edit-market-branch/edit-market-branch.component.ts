import {Component, Input, OnInit} from '@angular/core';
import {FormBuilder, FormGroup, Validators} from '@angular/forms';
import {MarketBranchService} from '../../services/market-branch.service';
import {ListMarketBranchesComponent} from '../list-market-branches/list-market-branches.component';
import {City} from '../../../../models/city.model';
import {CityService} from '../../services/city.service';

@Component({
  selector: 'app-edit-market-branch',
  templateUrl: './edit-market-branch.component.html',
  styleUrls: ['./edit-market-branch.component.scss'],
})
export class EditMarketBranchComponent implements OnInit {
  @Input() marketBranchObject: any;

  validateForm!: FormGroup;
  listCities: City[] = [];
  city: City;

  constructor(private marketBranchService: MarketBranchService,
              private cityService: CityService,
              private listMarketBranchesComponent: ListMarketBranchesComponent,
              private fb: FormBuilder,
              ) {
  }

  ngOnInit() {
    this.getCities();
    this.city = {id: this.marketBranchObject.address.city.id,name: this.marketBranchObject.address.city.name};
    this.validateForm = this.fb.group({
      name: [null, [Validators.required]],
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

  compareFn = (o1: any, o2: any): boolean => (o1 && o2 ? o1.id === o2.id : o1 === o2);

  private updateMarketBranch() {
    if (this.validateForm.valid) {
      const formData = this.validateForm.value;
      this.marketBranchService.updateMarketBranch(formData,this.marketBranchObject.id)
        .subscribe(response => {
          this.listMarketBranchesComponent.handleCancelEditModal(this.marketBranchObject);
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
