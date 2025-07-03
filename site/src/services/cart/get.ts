import { ICart, CartResponse, CartItemResponse } from "@/interfaces/ICart";
import { IProduct } from "@/interfaces/IProduct";

export const fetchCart = async (
  id_cliente: number,
  token?: string
): Promise<ICart> => {
  const response = await fetch(
    `http://localhost:8080/carrinho/get.php?id_cliente=${id_cliente}`,
    {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        ...(token && { Authorization: `Bearer ${token}` }),
      },
    }
  );
  const data: CartResponse = await response.json();
  if (data.status !== "success") throw new Error(data.message);

  const cartItems = data.data.items.flatMap((item) =>
    item.produtos.map((p: CartItemResponse) => ({
      product: {
        id_produto: p.id_produto,
        produto: p.produto,
        descricao: p.descricao || "",
        id_marca: p.id_marca,
        imagem: p.imagem || "",
        preco: p.preco,
        marca: p.marca,
      } as IProduct,
      quantity: p.quantidade,
    }))
  );

  return {
    items: cartItems,
    total: data.data.total,
  };
};
