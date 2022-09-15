import {MarketBranch} from "./MarketBranch";

export interface Market{
  id: number;
  name: string;
  marketbranches: MarketBranch[];
  editModalIsVisible: false;
}
