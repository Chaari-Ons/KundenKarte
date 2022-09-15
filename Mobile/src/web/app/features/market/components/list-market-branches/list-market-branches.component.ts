import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {MarketBranch} from '../../../../models/MarketBranch';
import {MarketService} from '../../services/market.service';


@Component({
  selector: 'app-list-market-branches',
  templateUrl: './list-market-branches.component.html',
  styleUrls: ['./list-market-branches.component.scss'],
})
export class ListMarketBranchesComponent implements OnInit {
  addModalIsVisible = false;
  listOfMarketBranch: MarketBranch[] = [];
  marketId: number;
  isLoading = false;

  constructor(private marketService: MarketService,
              private activatedRoute: ActivatedRoute,
              private router: Router) { }

  ngOnInit(): void {
    this.getMarketsById();
  }

  getMarketsById() {
    this.isLoading=true;
    const idMarket  = JSON.parse(atob(this.activatedRoute.snapshot.params['url']));
    this.marketService.getMarketsById(idMarket)
      .subscribe(response => {
        this.isLoading = false;
        this.listOfMarketBranch = response['data'].market_branches.data;
        this.marketId = response['data'].id;
      }, err => {
        this.isLoading = false;
        console.log(err);
      });
  }

  showAddModal(): void {
    this.addModalIsVisible = true;
  }

  handleCancelAddModal(): void {
    this.addModalIsVisible = false;
  }

  showEditModal(marketBranchObject): void {
    marketBranchObject.editModalIsVisible = true;
  }

  handleCancelEditModal(marketBranchObject): void {
    marketBranchObject.editModalIsVisible = false;
  }
}
