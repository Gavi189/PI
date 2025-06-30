import { IProduct } from "./IProduct";

export interface ICart {
  id_cart?: number;
  items: ICartItem[];
  total: number;
}

export interface ICartItem {
  product: IProduct;
  quantity: number;
}
