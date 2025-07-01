import { IProduct } from "./IProduct";

export interface ICart {
  items: ICartItem[];
  total: number;
}

export interface ICartItem {
  product: IProduct;
  quantity: number;
}

export interface CartItemResponse {
  id_rl: number;
  id_produto: number;
  produto: string;
  descricao: string | null;
  id_marca: number;
  imagem: string | null;
  preco: number;
  marca: string;
  quantidade: number;
}

export interface CartResponse {
  status: string;
  message: string;
  data: {
    items: Array<{
      id_carrinho: number;
      data: string;
      id_cliente: number;
      cliente_nome: string;
      produtos: CartItemResponse[];
      preco_total: number;
    }>;
    total: number;
  };
}
