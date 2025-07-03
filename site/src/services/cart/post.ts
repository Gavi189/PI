import { IProduct } from "@/interfaces/IProduct";

export const addToCart = async (
  product: IProduct,
  id_cliente: number,
  quantidade: number,
  token?: string
): Promise<boolean> => {
  const response = await fetch("http://localhost:8080/carrinho/post.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      ...(token && { Authorization: `Bearer ${token}` }),
    },
    body: JSON.stringify({
      id_cliente,
      id_produto: product.id_produto,
      quantidade,
    }),
  });
  return response.ok;
};
