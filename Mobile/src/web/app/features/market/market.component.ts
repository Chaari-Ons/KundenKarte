import {Component, OnInit} from '@angular/core';
import {NzModalService} from 'ng-zorro-antd/modal';
import {Router} from '@angular/router';
import {MarketService} from './services/market.service';
import {Market} from '../../models/Market';
import {environment} from 'src/environments/environment';
import {AuthService} from '../auth/services/auth.service';

@Component({
  selector: 'app-market',
  templateUrl: './market.component.html',
  styleUrls: ['./market.component.scss'],
})
export class MarketComponent implements OnInit {
  publicUrl = environment.public;
  addModalIsVisible = false;
  listMarkets: Market[] = [];
  isLoading = false;

  constructor(private marketService: MarketService, private modal: NzModalService, private router: Router,
              public authService: AuthService) {
  }

  ngOnInit(): void {
    this.getMarkets();
  }

  getMarkets() {
    this.isLoading=true;
    this.marketService.getMarkets()
      .subscribe(response => {
        this.listMarkets = response['data'];
        this.isLoading = false;
      }, err => {
        console.log(err);
        this.isLoading = false;
      });
  }

  showAddModal(): void {
    this.addModalIsVisible = true;
  }

  handleCancelAddModal(): void {
    this.addModalIsVisible = false;
  }

  showEditModal(marketObject): void {
    marketObject.editModalIsVisible = true;
  }

  handleCancelEditModal(marketObject): void {
    marketObject.editModalIsVisible = false;
  }

  showDeleteConfirm(marketId): void {
    this.modal.confirm({
      nzTitle: 'Are you sure delete this task?',
      nzContent: '<b style="color: red;">Some descriptions</b>',
      nzOkText: 'Yes',
      nzOkType: 'primary',
      nzOkDanger: true,
      nzOnOk: () => this.deleteMarket(marketId),
      nzCancelText: 'No',
      nzOnCancel: () => console.log('Cancel')
    });
  }

  deleteMarket(marketId){
    this.marketService.deleteMarkets(marketId)
      .subscribe(response => {
       this.getMarkets();
      }, err => {
        console.log(err);
      });
  }

  showMarketBranches(id) {
    const url = btoa(JSON.stringify(id));
    this.router.navigateByUrl('application/markets/list-market-branches/' + url);
  }
}
