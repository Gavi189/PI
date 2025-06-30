import { ICart } from "@/interfaces/ICart";

interface CartItemResponse {
  id_produto: number;
  produto: string;
  descricao: string;
  id_marca: number;
  imagem: string;
  preco: number;
  marca: string;
  quantidade: number;
}

export const fetchCart = async (id_cliente: number): Promise<ICart> => {
  const response = await fetch(
    `http://localhost:8080/carrinho?id_cliente=${id_cliente}`,
    {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    }
  );
  const data = await response.json();
  return {
    items: data.data.items.map((item: CartItemResponse) => ({
      product: {
        id_produto: item.id_produto,
        produto: item.produto,
        descricao: item.descricao,
        id_marca: item.id_marca,
        imagem: item.imagem,
        preco: item.preco,
        marca: item.marca,
      },
      quantity: item.quantidade,
    })),
    total: data.data.total,
  };
};
